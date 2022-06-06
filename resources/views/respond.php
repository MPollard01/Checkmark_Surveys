<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="../../../resources/assets/js/response.js"></script>

<div class="container mt-5">
    <form id="survey-form" class="form-control shadow border-0 row g-3 mx-auto py-4" style="width: 70%" action="" method="post">
    <div class="row justify-content-end">
        <div class="col-8 mb-5">
            <h1 class="text-center"><?php echo $survey['title'] ?></h1> 
        </div>
        <div class="col-2 mb-5">
            <img style="width: 100px;" src="<?php echo $_ENV['BASE_URL'] ?>/images/logo2.svg"/>
        </div>
    </div>
        <?php
            foreach($survey['questions'] as $index => $value)
            {
                echo'<div class="row g-3 ps-5 mb-2">
                        <div class="col">
                            <h4>'.$value->text.'</h4>
                        </div>';

                    if($value->type === 'radio' || $value->type === 'checkbox')
                    {
                        foreach($value->options as $i => $opt)
                        {
                            echo '<div class="form-check ps-5">
                                    <input class="form-check-input" type="'.(($value->type === 'radio') ? 'radio' : 'checkbox').'" name="'.(($value->type === 'radio') ? ('radio'.($index + 1)) : $opt.'-C'.($index + 1)).'" value="'.$opt.'" '.(($value->type === 'checkbox') ? ('data-cb="'.$i.'"') : '').'>
                                    <label class="form-check-label">
                                        '.$opt.'
                                    </label>
                                </div>';
                        }
                        
                    }
                    else
                    {
                        echo '<div class="mb-3">
                                <input type="text" class="form-control" name="text'.($index + 1).'">
                            </div>';
                    }

                    echo '</div>';
            }
        ?>
        <div class="d-grid gap-2 col-4 mx-auto my-4 mt-5">
            <button class="btn btn-success" id="respond-btn" type="button">Send</button>
        </div>
    </form>
</div>