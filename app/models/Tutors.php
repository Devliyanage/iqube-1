<?php
class Tutors extends Model
{
    public $errors = [];
    public $emailerrors;
    public $request_errors = [];
    public function validate($data)
    {
        $this->errors = [];
        if (empty($data['username'])) {
            $this->errors['name_err'] = '*Enter name';
        }
        if (empty($data['fname'])) {
            $this->errors['name_err'] = '*Enter First name';
        }
        if (empty($data['lname'])) {
            $this->errors['name_err'] = '*Enter Last name';
        }
        if (empty($data['cno'])) {
            $this->errors['name_err'] = '*Enter Contact Number';
        }
        $query = "SELECT * FROM users WHERE email = :email";
        if (!filter_var($data['email'],FILTER_VALIDATE_EMAIL)) {
            $this->errors['email_err'] = '*Invalid Email';
        } elseif ($this->query($query, ['email' => $data['email']])) {
            $this->errors['email_err'] = '*Email already taken';
        }
        if (empty($data['password'])) {
            $this->errors['password_err'] = '*Please enter password';
        } elseif (strlen($data['password']) < 6) {
            $this->errors['password_err'] = '*Password must be at least 6 characters';
        }
        if (empty($data['confirm_password'])) {
            $this->errors['confirm_password_err'] = '*Please confirm password';
        } else {
            if ($data['password'] != $data['confirm_password']) {
                $this->errors['confirm_password_err'] = '*Passwords do not match';
            }
        }
        if (empty($this->errors)) {
            return true;
        }
        return false;
    }
public function get_tutors($subject=null)
{
    if($subject==null){
        $query = "SELECT * FROM tutors";
        return $this->query($query);
    }
    else{
        $query = "SELECT * FROM tutors WHERE subject = :subject";
        return $this->query($query,['subject'=>$subject]);
    }
}
public function get_tutor_count_subject_vise(){
    $query = "SELECT subject,COUNT(*) as count FROM tutors GROUP BY subject";
    return $this->query($query);
}
public function get_tutor($id)
{
    return $this->first([
        'tutor_id' => $id
    ], 'tutors', 'tutor_id');
}
public function add_new_tutor($data)
{
    if ($this->validate($data)) {
        $this->query("INSERT INTO users (username, email, password, role) VALUES (:username, :email, :password, :role)", [
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'role' => 'tutor'
        ]);
        $row = $this->first([
            'email' => $data['email']
        ], 'users', 'user_id');
        $this->query("INSERT INTO tutors (user_id, subject, fname, lname, username, email, cno) VALUES (:user_id, :subject, :fname, :lname, :username, :email, :cno)", [
            'user_id' => $row->user_id,
            'subject' => $_SESSION['USER_DATA']['subject'],
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'username' => $data['username'],
            'email' => $data['email'],
            'cno' => $data['cno']
        ]);
        return true;
    }
    return false;
}
public function validate_email_change($data)
{
    $this->emailerrors = [];
    $query = "SELECT * FROM users WHERE email = :email";
    $data['email'];
    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $this->emailerrors['email_err'] = '*Invalid Email';
    }
    elseif ($result = $this->query($query, ['email' => $data['email']])) {
        if (!empty($result)) {
            $this->emailerrors['email_err'] = '*Email already taken';
        }
    }
    if (empty($data['confirmemail'])) {
        $this->emailerrors['confirm_email_err'] = '*Please confirm email';
    } else {
        if ($data['email'] != $data['confirmemail']) {
            $this->emailerrors['confirm_email_err'] = '*Emails do not match';
        }
    }
    if (empty($data['subjectadminpassword'])) {
        $this->emailerrors['password_err'] = '*Please enter password';
    } elseif (!password_verify($data['subjectadminpassword'], $_SESSION['USER_DATA']['password'])) {
        $this->emailerrors['password_err'] = '*Wrong Password';
    }
    if (empty($this->emailerrors)) {
        return true;
    }
    print_r($this->emailerrors);
    return false;
}
public function update_tutor_email($data, $id)
{
    if ($this->validate_email_change($data)) {
        $this->query("UPDATE users SET email = :email WHERE user_id = :user_id", [
            'email' => $data,
            'user_id' => $id
        ]);
        $this->query("UPDATE tutors SET email = :email WHERE user_id = :user_id", [
            'email' => $data,
            'user_id' => $id
        ]);
        return true;
    }
    return false;
}
public function validate_tutor_requests($data,$cvdata)
{

    $this->request_errors = [];
        $query = "SELECT * FROM users WHERE username = :username";
        if (empty($data['fname'])) {
            $this->request_errors['fname_err'] = '*Enter First name';
        }
        if (empty($data['lname'])) {
            $this->request_errors['lname_err'] = '*Enter Last name';
        }
        if (empty($data['username'])) {
            $this->request_errors['uname_err'] = '*Enter name';
        }
        elseif ($this->query($query, ['username' => $data['username']])) {
            $this->request_errors['uname_err'] = '*Username already taken';
        }
        $query = "SELECT * FROM users WHERE email = :email";
        if(empty($data['email'])){
            $this->request_errors['email_err'] = '*Enter email';
        }
        elseif (!filter_var($data['email'],FILTER_VALIDATE_EMAIL)) {
            $this->request_errors['email_err'] = '*Invalid Email';
        } elseif ($this->query($query, ['email' => $data['email']])) {
            $this->request_errors['email_err'] = '*Email already taken';
        }
    if(empty($data['cno'])){
        $this->request_errors['cno_err'] = '*Enter contact number';
    }
    if(empty($data['subject'])){
        $this->request_errors['subject_err'] = '*Please choose a subject';
    }
    if(empty($data['qualification'])){
        $this->request_errors['qualification_err'] = '*Please choose a qualification';
    }
    if(empty($cvdata)){
        $this->request_errors['file_err'] = '*Please upload your CV';
    }elseif($cvdata['size'] > 1000000){
        $this->request_errors['file_err'] = '*File size too large';
    }

        if (empty($data['terms'])) {
            $this->request_errors['terms_err'] = '*Please accept terms and conditions';
        }
        if (empty($this->request_errors)) {
            return true;
        }
        return false;
}

public function make_a_tutor_request($data,$cv)
{

        $this->query("INSERT INTO tutor_requests (subject, fname, lname, username, email, cno, qualification, cv,message) VALUES (:subject, :fname, :lname, :username, :email, :cno, :qualification, :cv, :message)", [

            'subject' => $data['subject'],
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'username' => $data['username'],
            'email' => $data['email'],
            'cno' => $data['cno'],
            'qualification' => $data['qualification'],
            'cv' => $cv,
            'message' => $data['message']
            

        ]);
        return true;



}

}