<?php

class Feedback extends DB
{
    /*
     * array list of default input field
     * For showing clients testimonial you have to select
     * these fields must .
     *
     * otherwise view of testimonials will not show
     * perfectly
     *
     * better to see documentation or watch video tutorial
     *
     * */

    public $fields = array("name", "position", "companyname", "companywebsite", "email", "feedback", "rating", "image");
    public $name, $position, $companyName, $compnayWebsite, $email, $feedback, $rating, $image;

    /**
     * @param $imgUrl : Image directory form the root
     */
    function getData($imgUrl)
    {
        /*
         * Basic style for data view
         * @start form here
         */
        if ($this->settings("style") == "Basic") {
            $count = 0;
            $ll = $this->con->query("SELECT * FROM data WHERE status='approved' ORDER BY id DESC");
            $data = $ll;

            echo "<ul class='collection z-depth-1'>";

            foreach ($data as $d) {
                $count++;
                $tmp = array();
                $obj = json_decode($d['value']);

                echo "<li class='collection-item avatar'>";

                foreach ($obj as $field => $val) {
                    $a = in_array($field, $this->fields);
                    if ($a == "1") {
                        if ($field == "name") {
                            $this->name = $val;

                        } elseif ($field == "position") {
                            $this->position = $val;
                        } elseif ($field == "companyname") {
                            $this->companyName = $val;
                        } elseif ($field == "companywebsite") {
                            $this->compnayWebsite = $val;
                        } elseif ($field == "email") {
                            $this->email = $val;
                        } elseif ($field == "feedback") {
                            $this->feedback = $val;
                        } elseif ($field == "rating") {
                            $this->rating = $val;
                        } elseif ($field == "image") {
                            $this->image = $val;
                        }
                    } else {
                        array_push($tmp, $val);
                    }
                }
                if ($this->image == "") {
                    $this->image = $imgUrl . "people.png";
                }
                if ($this->settings("sImage") == "enable") {
                    echo "<img src=" . $this->image . "  class='circle'>";
                }

                echo "<span class='title'>$this->name</span>";

                if ($this->position == '' && $this->companyName == '') {
                } else {
                    if ($this->settings("sPosition") == "enable" && $this->settings("sCompanyName") == "enable") {
                        echo "<p>($this->position at $this->companyName)</p>";
                    }
                }

                if ($this->email == '') {
                } else {
                    if ($this->settings('sEmail') == 'enable') {
                        echo "<p>$this->email</p>";
                    }
                }

                if ($this->compnayWebsite == '') {
                } else {
                    if ($this->settings('sCompanyWebsite') == 'enable') {
                        echo "<p>$this->compnayWebsite</p>";
                    }
                }

                /*
                 * Count rating
                 */
                switch ($this->rating) {
                    case 1:
                        echo "<div class='rating'><i class=\"material-icons\">grade</i></div>";
                        break;
                    case 2:
                        echo "<div class='rating'><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i></div>";
                        break;
                    case 3:
                        echo "\"<div class='rating'><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i></div>";
                        break;
                    case 4:
                        echo "<div class='rating'><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i></div>";
                        break;
                    case 5:
                        echo "<div class='rating'><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i></div>";
                        break;
                    default:
                }

                echo "<p>$this->feedback</p>";

                foreach ($tmp as $tdata) {
                    echo "<p>$tdata</p>";
                }

                echo "</li>";

                $this->name = '';
                $this->position = '';
                $this->companyName = '';
                $this->compnayWebsite = '';
                $this->rating = '';
                $this->feedback = '';
                $this->image = '';
                $this->email = '';
            }
            echo "</ul>";
        } /*
         * Basic style end
         */
        else {
            if ($this->settings("style") == "Carousel") {
                $active = "f";
                $count = 0;
                $ll = $this->con->query("SELECT * FROM data WHERE status='approved' ORDER BY id DESC");
                $data = $ll;

                echo "<div class='client-cover center-align'>

                <div id='carousel-clients' class='carousel slide' data-ride='carousel'>
                    <div class='carousel-inner text-center'>";
                foreach ($data as $d) {
                    $count++;
                    if ($active == 'f') {
                        $active = 'active';
                    } else {
                        $active = '';
                    }
                    $tmp = array();
                    $obj = json_decode($d['value']);

                    echo "<div class='item " . $active . "'>";

                    foreach ($obj as $field => $val) {
                        $a = in_array($field, $this->fields);
                        if ($a == '1') {
                            if ($field == 'name') {
                                $this->name = $val;
                            } elseif ($field == 'position') {
                                $this->position = $val;
                            } elseif ($field == 'companyname') {
                                $this->companyName = $val;
                            } elseif ($field == 'companywebsite') {
                                $this->compnayWebsite = $val;
                            } elseif ($field == 'email') {
                                $this->email = $val;
                            } elseif ($field == 'feedback') {
                                $this->feedback = $val;
                            } elseif ($field == 'rating') {
                                $this->rating = $val;
                            } elseif ($field == 'image') {
                                $this->image = $val;
                            }
                        } else {
                            array_push($tmp, $val);
                        }
                    }

                    if ($this->image == '') {
                        $this->image = $imgUrl . 'people.png';
                    }
                    if ($this->settings('sImage') == 'enable') {
                        echo "<img src='" . $this->image . "'class='img-circle clients-img'>";
                    }
                    /*
                    * Count rating
                    */
                    switch ($this->rating) {
                        case 1:
                            echo "<div class='rating'><i class=\"material-icons\">grade</i></div>";
                            break;
                        case 2:
                            echo "<div class='rating'><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i></div>";
                            break;
                        case 3:
                            echo "<div class='rating'><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i></div>";
                            break;
                        case 4:
                            echo "<div class='rating'><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i></div>";
                            break;
                        case 5:
                            echo "<div class='rating'><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i></div>";
                            break;
                        default:
                    }

                    echo "<p class='card-title'>$this->feedback</p>";
                    echo "<h3>- $this->name</h3>";

                    if ($this->position != '' && $this->companyName != '') {
                        if ($this->settings('sPosition') == 'enable' && $this->settings('sCompanyName') == 'enable') {
                            echo "<p>($this->position at $this->companyName)</p>";
                        }
                    }

                    if ($this->email == '') {
                    } else {
                        if ($this->settings('sEmail') == 'enable') {
                            echo "<p>$this->email</p>";
                        }
                    }

                    if ($this->compnayWebsite == '') {
                    } else {
                        if ($this->settings('sCompanyWebsite') == 'enable') {
                            echo "<p>$this->compnayWebsite</p>";
                        }
                    }

                    foreach ($tmp as $tdata) {
                        echo "<p>$tdata</p>";
                    }

                    echo '</div>';

                    $this->name = '';
                    $this->position = '';
                    $this->companyName = '';
                    $this->compnayWebsite = '';
                    $this->rating = '';
                    $this->feedback = '';
                    $this->image = '';
                    $this->email = '';
                }
            } elseif ($this->settings("style") == "Grid") {
                $count = 0;
                $ll = $this->con->query("SELECT * FROM data WHERE status='approved' ORDER BY id DESC");
                $data = $ll;

                echo "<div class='row grid'>";

                foreach ($data as $d) {
                    $count++;
                    $tmp = array();
                    $obj = json_decode($d['value']);

                    echo '<div class="grid-sizer"></div>';
                    echo "<div class='col s12 m6 l4 grid-item'>";
                    echo "<div class='testimonial-grid z-depth-1'>";

                    foreach ($obj as $field => $val) {
                        $a = in_array($field, $this->fields);
                        if ($a == '1') {
                            if ($field == 'name') {
                                $this->name = $val;
                            } elseif ($field == 'position') {
                                $this->position = $val;
                            } elseif ($field == 'companyname') {
                                $this->companyName = $val;
                            } elseif ($field == 'companywebsite') {
                                $this->compnayWebsite = $val;
                            } elseif ($field == 'email') {
                                $this->email = $val;
                            } elseif ($field == 'feedback') {
                                $this->feedback = $val;
                            } elseif ($field == 'rating') {
                                $this->rating = $val;
                            } elseif ($field == 'image') {
                                $this->image = $val;
                            }
                        } else {
                            array_push($tmp, $val);
                        }
                    }
                    if ($this->image == '') {
                        $this->image = $imgUrl . 'people.png';
                    }
                    if ($this->settings('sImage') == 'enable') {
                        echo "<img src=" . $this->image . "  class='circle fImg'>";
                    }
                    /*
                     * Count rating
                     */
                    switch ($this->rating) {
                        case 1:
                            echo "<div class='rating'><i class=\"material-icons\">grade</i></div>";
                            break;
                        case 2:
                            echo "<div class='rating'><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i></div>";
                            break;
                        case 3:
                            echo "<div class='rating'><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i></div>";
                            break;
                        case 4:
                            echo "<div class='rating'><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i></div>";
                            break;
                        case 5:
                            echo "<div class='rating'><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i></div>";
                            break;
                        default:
                    }

                    echo "<p class='card-title'>$this->name</p>";

                    if ($this->position != '' && $this->companyName != '') {
                        if ($this->settings('sPosition') == 'enable' && $this->settings('sCompanyName') == 'enable') {
                            echo "<p>($this->position at $this->companyName)";
                        }
                    }
                    if ($this->email == '') {
                    } else {
                        if ($this->settings('sEmail') == 'enable') {
                            echo '<p>' . $this->email . '</p>';
                        }
                    }
                    if ($this->compnayWebsite == '') {
                    } else {
                        if ($this->settings('sCompanyWebsite') == 'enable') {
                            echo '<p>' . $this->compnayWebsite . '</p>';
                        }
                    }
                    echo '<p class="card-content">' . $this->feedback . '</p>';

                    foreach ($tmp as $tdata) {
                        echo $tdata;
                    }

                    echo '</div></div>';

                    $this->name = "";
                    $this->position = "";
                    $this->companyName = "";
                    $this->compnayWebsite = "";
                    $this->rating = "";
                    $this->feedback = "";
                    $this->image = "";
                    $this->email = "";
                }

                echo '</div>';
            } else {

                echo "something went wrong";
            }
        }
    }

    public function getGridStyle($imageUrl)
    {
        $count = 0;
        $ll = $this->con->query("SELECT * FROM data WHERE status='approved' ORDER BY id DESC");
        $data = $ll;
        echo "<div class='row grid'>";
        foreach ($data as $d) {
            $count++;
            $tmp = array();
            $obj = json_decode($d['value']);
            echo '<div class="grid-sizer"></div>';
            echo "<div class='col s12 m6 l4 grid-item'>";
            echo "<div class='testimonial-grid z-depth-1'>";

            foreach ($obj as $field => $val) {
                $a = in_array($field, $this->fields);
                if ($a == "1") {
                    if ($field == "name") {
                        $this->name = $val;
                    } elseif ($field == "position") {
                        $this->position = $val;
                    } elseif ($field == "companyname") {
                        $this->companyName = $val;
                    } elseif ($field == "companywebsite") {
                        $this->compnayWebsite = $val;
                    } elseif ($field == "email") {
                        $this->email = $val;
                    } elseif ($field == "feedback") {
                        $this->feedback = $val;
                    } elseif ($field == "rating") {
                        $this->rating = $val;
                    } elseif ($field == "image") {
                        $this->image = $val;
                    }
                } else {
                    array_push($tmp, $val);
                }
            }
            if ($this->image == "") {
                $this->image = $imageUrl . "people.png";
            }
            if ($this->settings("sImage") == "enable") {
                echo "<img src=" . $this->image . " class='circle fImg'><br>";
            }
            /*
             * Countring rating
             */
            switch ($this->rating) {
                case 1:
                    echo "<div class='rating'><i class=\"material-icons\">grade</i></div>";
                    break;
                case 2:
                    echo "<div class='rating'><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i></div>";
                    break;
                case 3:
                    echo "<div class='rating'><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i></div>";
                    break;
                case 4:
                    echo "<div class='rating'><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i></div>";
                    break;
                case 5:
                    echo "<div class='rating'><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i></div>";
                    break;
                default:
            }
            echo "<p class='card-title'>" . $this->name . "</p>";

            if ($this->position != "" && $this->companyName != "") {
                if ($this->settings("sPosition") == "enable" && $this->settings("sCompanyName") == "enable") {
                    echo "(" . $this->position . " at " . $this->companyName . ")";
                }
            }
            if ($this->email == "") {
            } else {
                if ($this->settings("sEmail") == "enable") {
                    echo "<p>" . $this->email . "</p>";
                }
            }
            if ($this->compnayWebsite == "") {
            } else {
                if ($this->settings("sCompanyWebsite") == "enable") {
                    echo "<p>" . $this->compnayWebsite . "</p>";
                }
            }
            echo "<p class='card-content'>" . $this->feedback . "</p>";
            echo "<br>";
            foreach ($tmp as $tdata) {
                echo $tdata . "<br>";
            }
            echo "</div></div>";
            $this->name = "";
            $this->position = "";
            $this->companyName = "";
            $this->compnayWebsite = "";
            $this->rating = "";
            $this->feedback = "";
            $this->image = "";
            $this->email = "";
        }
    }

    public function getCarouselStyle($imageUrl)
    {
        $active = "f";
        $count = 0;
        $ll = $this->con->query("SELECT * FROM data WHERE status='approved' ORDER BY id DESC");
        $data = $ll;

        echo "<div class='client-cover center-align'><div id='carousel-clients' class='carousel slide' data-ride='carousel'><div class='carousel-inner text-center'>";

        foreach ($data as $d) {
            $count++;
            if ($active == 'f') {
                $active = 'active';
            } else {
                $active = '';
            }
            $tmp = array();
            $obj = json_decode($d['value']);

            echo "<div class='item " . $active . "'>";

            foreach ($obj as $field => $val) {
                $a = in_array($field, $this->fields);
                if ($a == '1') {
                    if ($field == 'name') {
                        $this->name = $val;
                    } elseif ($field == 'position') {
                        $this->position = $val;
                    } elseif ($field == 'companyname') {
                        $this->companyName = $val;
                    } elseif ($field == 'companywebsite') {
                        $this->compnayWebsite = $val;
                    } elseif ($field == 'email') {
                        $this->email = $val;
                    } elseif ($field == 'feedback') {
                        $this->feedback = $val;
                    } elseif ($field == 'rating') {
                        $this->rating = $val;
                    } elseif ($field == 'image') {
                        $this->image = $val;
                    }
                } else {
                    array_push($tmp, $val);
                }
            }

            if ($this->image == '') {
                $this->image = $imageUrl . 'people.png';
            }
            if ($this->settings('sImage') == 'enable') {
                echo "<img src='" . $this->image . "'class='img-circle clients-img'>";
            }
            /*
            * Count rating
            */
            switch ($this->rating) {
                case 1:
                    echo "<div class='rating'><i class=\"material-icons\">grade</i></div>";
                    break;
                case 2:
                    echo "<div class='rating'><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i></div>";
                    break;
                case 3:
                    echo "<div class='rating'><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i></div>";
                    break;
                case 4:
                    echo "<div class='rating'><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i></div>";
                    break;
                case 5:
                    echo "<div class='rating'><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i></div>";
                    break;
                default:
            }

            echo "<p class='card-title'>$this->feedback</p>";
            echo "<h3>- $this->name</h3>";

            if ($this->position != '' && $this->companyName != '') {
                if ($this->settings('sPosition') == 'enable' && $this->settings('sCompanyName') == 'enable') {
                    echo "<p>($this->position at $this->companyName)</p>";
                }
            }

            if ($this->email == '') {
            } else {
                if ($this->settings('sEmail') == 'enable') {
                    echo "<p>$this->email</p>";
                }
            }

            if ($this->compnayWebsite == '') {
            } else {
                if ($this->settings('sCompanyWebsite') == 'enable') {
                    echo "<p>$this->compnayWebsite</p>";
                }
            }

            foreach ($tmp as $tdata) {
                echo "<p>$tdata</p>";
            }

            echo '</div>';

            $this->name = '';
            $this->position = '';
            $this->companyName = '';
            $this->compnayWebsite = '';
            $this->rating = '';
            $this->feedback = '';
            $this->image = '';
            $this->email = '';
        }
    }

    public function getBasicStyle($imageUrl)
    {
        $count = 0;
        $data = $this->con->query("SELECT * FROM data WHERE status='approved' ORDER BY id DESC");

        echo "<ul class='collection z-depth-1'>";

        foreach ($data as $d) {
            $count++;
            $tmp = array();
            $obj = json_decode($d['value']);

            echo "<li class='collection-item avatar'>";

            foreach ($obj as $field => $val) {
                $a = in_array($field, $this->fields);
                if ($a == "1") {
                    if ($field == "name") {
                        $this->name = $val;

                    } elseif ($field == "position") {
                        $this->position = $val;
                    } elseif ($field == "companyname") {
                        $this->companyName = $val;
                    } elseif ($field == "companywebsite") {
                        $this->compnayWebsite = $val;
                    } elseif ($field == "email") {
                        $this->email = $val;
                    } elseif ($field == "feedback") {
                        $this->feedback = $val;
                    } elseif ($field == "rating") {
                        $this->rating = $val;
                    } elseif ($field == "image") {
                        $this->image = $val;
                    }
                } else {
                    array_push($tmp, $val);
                }
            }
            if ($this->image == "") {
                $this->image = $imageUrl . "people.png";
            }
            if ($this->settings("sImage") == "enable") {
                echo "<img src=" . $this->image . "  class='circle'>";
            }

            echo "<span class='title'>$this->name</span>";

            if ($this->position == '' && $this->companyName == '') {
            } else {
                if ($this->settings("sPosition") == "enable" && $this->settings("sCompanyName") == "enable") {
                    echo "<p>($this->position at $this->companyName)</p>";
                }
            }

            if ($this->email == '') {
            } else {
                if ($this->settings('sEmail') == 'enable') {
                    echo "<p>$this->email</p>";
                }
            }

            if ($this->compnayWebsite == '') {
            } else {
                if ($this->settings('sCompanyWebsite') == 'enable') {
                    echo "<p>$this->compnayWebsite</p>";
                }
            }

            /*
             * Count rating
             */
            switch ($this->rating) {
                case 1:
                    echo "<div class='rating'><i class=\"material-icons\">grade</i></div>";
                    break;
                case 2:
                    echo "<div class='rating'><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i></div>";
                    break;
                case 3:
                    echo "\"<div class='rating'><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i></div>";
                    break;
                case 4:
                    echo "<div class='rating'><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i></div>";
                    break;
                case 5:
                    echo "<div class='rating'><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i></div>";
                    break;
                default:
            }

            echo "<p>$this->feedback</p>";

            foreach ($tmp as $tdata) {
                echo "<p>$tdata</p>";
            }

            echo "</li>";

            $this->name = '';
            $this->position = '';
            $this->companyName = '';
            $this->compnayWebsite = '';
            $this->rating = '';
            $this->feedback = '';
            $this->image = '';
            $this->email = '';

        }
        echo "</ul>";
    }

    /**
     * @param $table : table name
     * @param $col : column name
     * @param $data : data which would be update
     * @param $first : condition first
     * @param $second : condition second
     */

    public function update($table, $col, $data, $first, $second)
    {
        $st = $this->con->prepare("UPDATE " . $table . " SET " . $col . "='$data' WHERE " . $first . "='$second'");
        try {
            $st->execute();
        } catch (PDOException $d) {
            echo "Something went wrong";

        }
    }

    /**
     * @param $tbl : Table name
     * @param $col : Column name
     * @param $data : Data that would be deleted
     */
    public function delete($tbl, $col, $data)
    {
        $st = $this->con->prepare("DELETE FROM " . $tbl . " WHERE " . $col . " = '" . $data . "'");
        try {
            $st->execute();
        } catch (PDOException $e) {
            echo "Something went wrong";
        }
    }

    /**
     * Si
     *
     * @param $imgUrl
     */
    public function dataList($imgUrl)
    {
        $count = 0;
        $this->select('data');
        $data = $this->table;

        foreach ($data as $d) {
            $count++;
            if ($d['status'] == "pending") {
                $btnPending = "disabled";
            } else {
                $btnPending = "";
            }
            if ($d['status'] == "approved") {
                $btnApproved = "disabled";
            } else {
                $btnApproved = "";
            }
            $id = $d['id'];
            $tmp = array();
            $obj = json_decode($d['value']);

            echo '<div class="row"><div class="col s12"><div class="card white">';

            foreach ($obj as $field => $val) {
                $a = in_array($field, $this->fields);
                if ($a == "1") {
                    if ($field == "name") {
                        $this->name = $val;
                    } elseif ($field == "position") {
                        $this->position = $val;
                    } elseif ($field == "companyname") {
                        $this->companyName = $val;
                    } elseif ($field == "companywebsite") {
                        $this->compnayWebsite = $val;
                    } elseif ($field == "email") {
                        $this->email = $val;
                    } elseif ($field == "feedback") {
                        $this->feedback = $val;
                    } elseif ($field == "rating") {
                        $this->rating = $val;
                    } elseif ($field == "image") {
                        $this->image = $val;
                    }
                } else {
                    array_push($tmp, $val);
                }
            }
            if ($this->image == "") {
                $this->image = $imgUrl . "people.png";
            }
            echo '<div class="card-content grey-text text-darken-4 center-align">';
            echo "<div class='card-title'><img src=$this->image class='circle'></div>";
            echo "<span class='card-title'>$this->name</span>";

            /*
             * Count rating
             */
            switch ($this->rating) {
                case 1:
                    echo "<div class='rating'><i class=\"material-icons\">grade</i></div>";
                    break;
                case 2:
                    echo "<div class='rating'><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i></div>";
                    break;
                case 3:
                    echo "<div class='rating'><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i></div>";
                    break;
                case 4:
                    echo "<div class='rating'><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i></div>";
                    break;
                case 5:
                    echo "<div class='rating'><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i><i class=\"material-icons\">grade</i></div>";
                    break;
                default:
            }

            if ($this->position != "" && $this->companyName != "") {
                echo "<p>($this->position at $this->companyName)</p>";
            }
            if ($this->email == "") {
            } else {
                echo "<p>" . $this->email . "</p>";
            }
            if ($this->compnayWebsite == "") {
            } else {
                echo "<p>" . $this->compnayWebsite . "</p>";
            }

            echo '</div><div class="card-content">';

            echo "<p>$this->feedback</p>";

            foreach ($tmp as $tdata) {
                echo "<p>" . $tdata . "</p>";
            }
            echo "</div><div class='card-action'><div class='row many-buttons'><div class='col s12 m4 l4'><button data-name='approve' data-id='" . $id . "' id='approve' class='waves-effect waves-light btn green' $btnApproved>Approve</button></div><div class='col s12 m4 l4'><button data-name='disapprove' data-id='" . $id . "' id='disapprove' class='waves-effect waves-light btn orange' $btnPending >Disapprove</button></div><div class='col s12 m4 l4'><button data-name='delete' data-id='" . $id . "' id='deleteTestimonial' class='waves-effect waves-light btn red'>Delete</button></div></div></div>";
            echo '</div></div></div>';

            $this->name = "";
            $this->position = "";
            $this->companyName = "";
            $this->compnayWebsite = "";
            $this->rating = "";
            $this->feedback = "";
            $this->image = "";
            $this->email = "";
        }
    }

    /**
     * @param $table : Table name
     */

    public function countAll($table)
    {
        $count = $this->con->prepare("select * from " . $table);
        $count->execute();
        echo $count->rowCount();
    }

    /**
     * @param $tbl : Table name
     * @param $col : Column name
     * @param $data : Countable data
     */
    public function count($tbl, $col, $data)
    {
        $count = $this->con->prepare("select * from " . $tbl . " WHERE " . $col . "='" . $data . "'");
        $count->execute();
        echo $count->rowCount();
    }
}
