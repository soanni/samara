<?php


class User extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('user_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('My_PHPMailer');
    }

    public function confirm($id=null){
        $data = new stdClass();
        $data->id = $id;
        //gets user using confirm_string
        $user = $this->user_model->getUser($id,true);
        if(!empty($user)){
            if($user['locked']){
                $username = $user['username'];
                $data->title = "Confirmation for user {$username}";
                $rules = array(
                    array(
                        'field'=>'password',
                        'label'=>'Password',
                        'rules'=>array('trim','required','min_length[6]')
                    ),
                    array(
                        'field'=>'password_confirm',
                        'label'=>'Confirm password',
                        'rules'=>array('trim','required','min_length[6]','matches[password]')
                    )
                );
                $this->form_validation->set_rules($rules);
                if ($this->form_validation->run() === FALSE) {
                    $this->load->view('templates/header',$data);
                    $this->load->view('user/register/password_creation', $data);
                    $this->load->view('templates/footer');
                }else{
                    $password = $this->input->post('password');
                    if($this->user_model->update_with_password($user['user_id'],$password)){
                        $data->register_message = "New password was successfully set. Your account is unlocked now.";
                        $this->load->view('templates/header',$data);
                        $this->load->view('user/register/register_success',$data);
                        $this->load->view('templates/footer');
                    }
                }
            }else{
                $this->load->view('user/register/already_confirmed');
                $this->load->view('templates/footer');
            }
        }else{
            $this->load->view('user/register/wrong_user');
        }

    }

    public function register(){
        $data = new stdClass();
        $data->title = 'Register new user';
        $rules = array(
            array(
                'field'=>'username',
                'label'=>'Username',
                'rules'=>array('trim','required','alpha_numeric','min_length[4]','is_unique[users.username]'),
                'errors'=>array('is_unique' => 'This username already exists. Please choose another one.')
            ),
            array(
                'field'=>'email',
                'label'=>'Email',
                'rules'=>array('trim','required','valid_email','is_unique[users.email]')
            )
        );
        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header',$data);
            $this->load->view('user/register/register', $data);
            $this->load->view('templates/footer');
        }else{
            $data->username = $this->input->post('username');
            $data->email = $this->input->post('email');
            $inserted_id = $this->user_model->create_user($data->username, $data->email);
            if($inserted_id){
                $confirm_str = $this->user_model->getConfirmString($inserted_id);
                // sending email with confirmation link
                $this->send_email_link($confirm_str);
                if(!is_null($confirm_str)){
                    $data->register_message = "Thank you for registering your new account. Your account is currently locked.
                                        Please follow the link sent to email {$data->email} to assign the password and
                                        unlock your account.";
                    $this->load->view('templates/header',$data);
                    $this->load->view('user/register/register_success',$data);
                    $this->load->view('templates/footer');
                }
            }else{
                $data->error = 'There was a problem during the creation of your new account. Please try again.';
                $this->load->view('templates/header',$data);
                $this->load->view('user/register/register', $data);
                $this->load->view('templates/footer');
            }
        }
    }

    public function send_email_link($confirmation){
        $link = "http://localhost/code_igniter/index.php/user/confirm/{$confirmation}";
        $data = new stdClass();
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth   = true;
        $mail->SMTPSecure = "ssl";
        $mail->Host       = "smtp.gmail.com";
        $mail->Port       = 465;
        $mail->Username   = "legandr.86@gmail.com";
        $mail->Password   = "7evDSyQfcR";
        $mail->SetFrom('admin@samaranews.com', 'Andrey Andreev');
        $mail->AddReplyTo('admin@samaranews.com', 'Andrey Andreev');  //email address that receives the response
        $mail->Subject    = "Samara news registration confirmation";
        $mail->Body      = "{$link}";
        $mail->AltBody    = "Plain text message";
        $destination = "rumazda@outlook.com";
        $mail->AddAddress($destination, "John Doe");
        if(!$mail->Send()) {
            $data->message = "Error: " . $mail->ErrorInfo;
        } else {
            $data->message = "Message sent correctly!";
        }
        $this->load->view('user/register/sent_mail',$data);
    }
}