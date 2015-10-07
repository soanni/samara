<?php


class User extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('user_model');
        $this->load->helper('form');
        $this->load->helper('url_helper');
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
                    $this->load->view('templates/newspaper_header',$data);
                    $this->load->view('user/register/password_creation', $data);
                    $this->load->view('templates/newspaper_footer');
                }else{
                    $password = $this->input->post('password');
                    if($this->user_model->update_with_password($user['user_id'],$password)){
                        $data->register_message = "New password was successfully set. Your account is unlocked now.";
                        $this->loadRegisterStatementView($data);
                    }
                }
            }else{
                $data->title = 'Confirmation error';
                $data->register_message = "This account is already confirmed";
                $this->loadRegisterStatementView($data);
            }
        }else{
            $data->title = 'Wrong user';
            $data->register_message = "There is no such user in the system. Please, check the confirmation link against the one in the email sent to you";
            $this->loadRegisterStatementView($data);
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
            $this->load->view('templates/newspaper_header',$data);
            $this->load->view('user/register/register', $data);
            $this->load->view('templates/newspaper_footer');
        }else{
            $data->username = $this->input->post('username');
            $data->email = $this->input->post('email');
            $inserted_id = $this->user_model->create_user($data->username, $data->email);
            if($inserted_id){
                $confirm_str = $this->user_model->getConfirmString($inserted_id);
                // sending email with confirmation link
                if(!is_null($confirm_str)){
                    $this->send_email_link($confirm_str, $data);
                    $data->register_message = "Thank you for registering your new account. Your account is currently locked.
                                        Please follow the link sent to email {$data->email} to assign the password and
                                        unlock your account.";
                    $this->loadRegisterStatementView($data);
                }
            }else{
                $data->error = 'There was a problem during the creation of your new account. Please try again.';
                $this->load->view('templates/newspaper_header',$data);
                $this->load->view('user/register/register', $data);
                $this->load->view('templates/newspaper_footer');
            }
        }
    }

    ///////////////////////////////

    private function loadRegisterStatementView($data){
        $this->load->view('templates/newspaper_header',$data);
        $this->load->view('user/register/register_statement',$data);
        $this->load->view('templates/newspaper_footer');
    }

    /**
     * send email via mail.ru account
     */

    private function send_email_link($confirmation, $data){
        $link = site_url('user/confirm') . "/{$confirmation}";
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth   = true;
        $mail->SMTPSecure = "ssl";
        $mail->Host       = "smtp.mail.ru";
        $mail->Port       = 465;
        $mail->Username   = "crossover_trial@mail.ru";
        $mail->Password   = "jd5xugLMrr";
        $mail->SetFrom('crossover_trial@mail.ru', 'Webmaster');
        $mail->AddReplyTo('admin@samaranews.com', 'Andrey Andreev');
        $mail->Subject    = "Samara news registration confirmation";
        $mail->Body      = "{$link}";
        $mail->AltBody    = "Plain text message";
        $destination = "legandr.86@gmail.com";
        $mail->AddAddress($destination, "John Doe");
        if(!$mail->Send()){
            $data->mail_message = "Error: " . $mail->ErrorInfo;
            return 0;
        } else {
            $data->mail_message = "Message sent correctly!";
            return 1;
        }
    }
}