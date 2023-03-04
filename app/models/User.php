<?php

require_once 'App.php';

class User extends App
{
    // table
    protected $table;

    // properties
    protected $id = null;
    protected $username;
    protected $password;
    protected $name;
    protected $avatar = 'no-avatar.jpg';
    protected $number;
    protected $userType;


    /***************************************************************************
     * User constructor
     *
     * @param $username
     * @param $password
     * @param $userType
     */
    public function __construct($username, $password, $userType)
    {
        parent::__construct();
        $this->username = $username;
        $this->password = $password;
        $this->table = $userType . 's';
        $this->userType = $userType;

        // get other info
        if($username != '' && $password != '') {
            $stmt = $this->conn->prepare("SELECT * FROM $this->table WHERE username = ? AND password = ?");
            $stmt->bind_param("ss", $this->username, $this->password);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $this->id = $row['id'];
                $this->name = $row['name'];
                $this->avatar = $row['avatar'];
                $this->number = $row['number'];
            }
        }
    }


    /***************************************************************************
     * Convert user object to array
     *
     * @param array $append
     * @return array
     */
    public function toArray($append = [])
    {
        $arr = [
            'id'       => $this->id,
            'number'   => $this->number,
            'name'     => $this->name,
            'avatar'   => $this->avatar,
            'username' => $this->username,
            'userType' => $this->userType
        ];

        // append
        foreach($append as $key => $value) {
            $arr[$key] = $value;
        }

        return $arr;
    }


    /***************************************************************************
     * Get currently signed-in user
     *
     * @return array|null
     */
    public static function getUser()
    {
        $user_info = null;
        if(isset($_SESSION['user']) && isset($_SESSION['pass'])) {
            $authenticated = (new User(
                $_SESSION['user']['username'],
                $_SESSION['pass'],
                $_SESSION['user']['userType']
            ))->signIn();

            if($authenticated)
                $user_info = $authenticated->toArray();
            else
                session_destroy();
        }
        return $user_info;
    }


    /***************************************************************************
     * Authenticated or not
     *
     * @return bool
     */
    public function authenticated()
    {
        return (bool)$this->id;
    }


    /***************************************************************************
     * Sign in
     *
     * @return $this|false
     */
    public function signIn()
    {
        if($this->authenticated()) {
            $_SESSION['user'] = $this->toArray();
            $_SESSION['pass'] = $this->password;
            return $this;
        }
        return false;
    }


    /***************************************************************************
     * Set name
     *
     * @param string $name
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }


    /***************************************************************************
     * Set avatar
     *
     * @param string $avatar
     * @return void
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }


    /***************************************************************************
     * Set number
     *
     * @param int $number
     * @return void
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }


    /***************************************************************************
     * Set username
     *
     * @param string $username
     * @return void
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }


    /***************************************************************************
     * Set password
     *
     * @param string $password
     * @return void
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }


    /***************************************************************************
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    /***************************************************************************
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }


    /***************************************************************************
     * Get avatar
     *
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }


    /***************************************************************************
     * Get number
     *
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }


    /***************************************************************************
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }


    /***************************************************************************
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
}
