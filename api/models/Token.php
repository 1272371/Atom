<?php

    class Token {

        // database stuff
        private $conn;

        // properties
        public $ok;
        public $token;
        public $user_id;
        public $user_name;
        public $user_type;
        public $user_surname;
        public $user_password;

        // user constructor
        public function __construct($db) {
            $this->conn = $db;
        }

        /**
         * 
         */
        public function setToken() {

            $query = 'SELECT
                u.user_id,
                utl.utl_name as user_type,
                u.user_name,
                u.user_surname,
                u.user_password,
                u.utl_id
                FROM
                user u
                LEFT JOIN
                user_type_lookup utl
                ON
                u.utl_id = utl.utl_id
                WHERE
                u.user_id = ?
                LIMIT 0, 1';

            // prepare query
            $statement = $this->conn->prepare($query);

            // bind id
            $statement->bindParam(1, $this->user_id);

            // execute query
            $statement->execute();

            $row = $statement->fetch(PDO::FETCH_ASSOC);

            // set token and cookies
            if ($this->user_id == $row['user_id']) {

                // user exists check password
                if (password_verify($this->user_password, $row['user_password'])) {

                    // delete password
                    $row['user_password'] = 'none';

                    // create token
                    $cryptstrong = true;
                    $token = bin2hex(openssl_random_pseudo_bytes(64,$cryptstrong));

                    // create query
                    $tokenQuery = 'INSERT
                        INTO token
                        SET
                        token = :token,
                        user_id = :user_id';

                    setcookie('atom_risk', $token, time() + 60 * 60 * 24 * 7, '/', null, null, true);
                    setcookie('risk_snid', '1', time()+ 60 * 60 * 24 * 3, '/', null, null, true);

                    // prepare statement
                    $state = $this->conn->prepare($tokenQuery);
                    $tokenSha1 = sha1($token);

                    // bind data
                    $state->bindParam(':token', $tokenSha1);
                    $state->bindParam(':user_id', $row['user_id']);

                    $this->ok = $state->execute();

                    if ($this->ok) {
                        // ok
                        http_response_code(200);
                        $this->user_id = $row['user_id'];
                        $this->user_type = $row['user_type'];
                        $this->user_name = $row['user_name'];
                        $this->user_surname = $row['user_surname'];
                    }
                }
            }
        }

        public function getToken() {

            $query = 'SELECT
                t.token,
                u.user_password as user_password
                FROM
                token t
                LEFT JOIN
                user u
                ON
                t.user_id = u.user_id
                WHERE
                t.user_id = ?
                LIMIT 0, 1';

            // prepare query
            $statement = $this->conn->prepare($query);

            // bind id
            $statement->bindParam(1, $this->user_id);

            // execute query
            $statement->execute();

            $row = $statement->fetch(PDO::FETCH_ASSOC);

            // set properties
            $this->token = $row['token'];
            $this->user_password = $row['user_password'];
        }
    }