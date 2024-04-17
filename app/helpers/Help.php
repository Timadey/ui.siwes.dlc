<?php
namespace app\helpers;

class Help
{
        /**
         * randomCharacters - Returns a random string
         */
        public static function prepareLike($value) {
                // $v = str_replace("`", "%", $value);
                return "%$value%";
        }
    
        /**
         * randomCharacters - Returns a random string
         */
        public static function randomCharacters($length = 32, $numeric = false) {
    
                $random_string = "";
                while(strlen($random_string)<$length && $length > 0) {
                    if($numeric === false) {
                        $randnum = mt_rand(0,61);
                        $random_string .= ($randnum < 10) ?
                            chr($randnum+48) : ($randnum < 36 ? 
                                chr($randnum+55) : chr($randnum+61));
                    } else {
                        $randnum = mt_rand(0,9);
                        $random_string .= chr($randnum+48);
                    }
                }
                return $random_string;
        }

        /**
         * clean - clean user's form input
         * @input: input to clean
         * Return: the cleaned input
         */
        public static function clean($input)
        {
                $input = htmlspecialchars($input??'');
                $input = strip_tags($input);
                $input = trim($input);
                return $input;
        }
        /**
         * alert - bootstrap alert messages
         * @msg: alert messages
         * @status: alert status; 0 for failure, 1 for success
         * Return: a bootstrap alert div containing the alert message
         */
        public static function alert (string $msg, int $status)
        {
                if ($status === 0)
                {
                        return ("<div class = 'alert alert-danger' role = 'alert'><strong>$msg</strong></div>");
                }
                else if ($status === 1)
                {
                        return ("<div class = 'alert alert-success' role = 'alert'><strong>$msg</strong></div>");
                }
        }
        /**
         * getLimit - get limit of database query
         */
        public static function getLimit(int $total)
        {
                if (isset($_GET['no']) && is_int($_GET['no']))
                {
                        $page_no = $_GET['page_no'];
                }else $page_no = 1;
                $next_page = $page_no + 1;
                $prev_page = $page_no - 1;
                $per_page = 5;
                $offset = $per_page * $page_no;
                $total_per_page = ceil($total/$per_page);
                $second_last = $total_per_page - 1;

        }
}
?>