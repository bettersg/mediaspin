<?php

require_once 'vendor/autoload.php';

$client = new \Google_Client();
$client->setApplicationName('mediaspin');
$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
$client->setAccessType('offline');
$client->setAuthConfig('keys/linen-shape-235814-8f56fff7fca3.json');
$service = new Google_Service_Sheets($client);
$spreadsheetId = "1UFxBBWljwEjL26PeS0is0bHMFKE0N_xLa_DmI9jngAE";

if(isset($_POST['issue_title']))
{
   append_new_issue();
} 

function append_new_issue() {
    $range = 'issues';
    $values = [
        [null, date("d/m/Y"), $_POST["issue_title"]],
    ];
    $body = new Google_Service_Sheets_ValueRange([   
        'values' => $values 
    ]);
    $params = [    
        'valueInputOption' => "RAW" 
    ];
    $insert = [
        "insertDataOption" => "INSERT_ROW"
    ];
    $result = $service->spreadsheets_values->append($spreadsheetId, $range, $body, $params,$insert);
}


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>SG MediaSpin - a project by better.sg</title>
        <!-- Bootstrap core CSS -->
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="jumbotron.css" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css">
    </head>
    <body>
        <!-- Main jumbotron for a primary marketing message or call to action -->
        <div class="jumbotron jumbotron-fluid" style="background-position: right top; background-size: contain; background-repeat: no-repeat; background-color: #ffffff; background-clip: border-box; background-image: url('assets/images/undraw_online_articles_79ff.png');">
            <div class="container white_tint_jumbotron">
                <h1 class="display-3 font-weight-bold text-primary titlespin">SG Media Spin</h1>
                <p class="font-weight-bolder">How different websites report the same thing.</p>
                <a class="btn btn-primary" href="#" role="button">Learn more »</a>
                <a class="btn btn-warning" href="#" role="button" style="margin-left: 2rem;" data-toggle="modal" data-target="#exampleModal">Add an Issue <i class="fa-lg fa-plus-circle fas text-primary"></i></a>
            </div>
            <div class="fade modal pg-show-modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">New Spin Issue Submission</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="index.php" method="post">
                                <div class="form-group">
                                    <label for="issue_title" class="form-control-label">Title of the Issue or Incident (phrased simply and objectively)</label>
                                    <input type="text" class="form-control" name="issue_title" id="issue_title" placeholder="e.g. Criticisms of Candidate ABC" required>
                                </div>
                                <div class="form-group">
                                    <label for="article1" class="form-control-label">Link to Article 1 that spins it:</label>
                                    <input type="text" class="form-control" name="article1" id="article1" required>
                                </div>
                                <div class="form-group">
                                    <label for="article2" class="form-control-label">Link to Article 2 that spins it differently:</label>
                                    <input type="text" class="form-control" id="article2" name="article2" required>
                                </div>
                            </form>
                            <p>X&nbsp; &nbsp; &nbsp;I am not a robot</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" name="submit" class="btn btn-primary"> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">

            <div class="row">
                <div class="col-md-7">
                    <h3>Current Spin</h3>
                    <hr/>
                    <div class="bg-light clearfix headline">
                        <span class="justify-content-between"> <h2 class="float-left text-primary">PM Lee took a walk in the garden before dinner.</h2> <small class="float-right text-right">24 Jun 2020</small> </span>
                    </div>
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action"> <div class="d-flex w-100 justify-content-between">
                                <h4 class="mb-1">Straits Times</h4>
                                <small>3 days ago</small>
                            </div><img src="https://static.mothership.sg/1/2020/06/2020-06-25-15.56.08.jpg" class="article_image img-fluid rounded-lg"><h6 class="article_image text-uppercase"> SUMIKO SAYS: PM LEE IS IN TOUCH WITH THE GROUND, LITERALLY. </h6> <p class="mb-1 card-text">This is the excerpt of the article. A wider card with supporting text below as a natural lead-in to additional content....</p><div class="card-footer" style="padding-left: 0.25rem; padding-right: 0.25rem;">
                                <div style="margin-top: 15px;"> 
                                    <label>How biased do you think this article and headline are?</label>
                                    <div class="btn-group btn-group-sm d-flex text-center" role="group" aria-label="Small button group">
                                        <button type="button" class="btn btn-secondary btn-vote">Very Negative</button>
                                        <button type="button" class="btn btn-secondary btn-vote">Slightly -</button>
                                        <button type="button" class="btn btn-secondary btn-vote">Neutral</button>
                                        <button type="button" class="btn btn-secondary btn-vote">Slightly +</button>
                                        <button type="button" class="btn btn-secondary btn-vote">Very Positive</button>
                                    </div>
                                </div>
                                <div style="margin-top: 15px;"> 
                                    <label>How much would you trust this article?</label>
                                    <div class="btn-group btn-group-sm d-flex text-center" role="group" aria-label="Small button group">
                                        <button type="button" class="btn btn-secondary btn-vote">Not at all</button>
                                        <button type="button" class="btn btn-secondary btn-vote">Slightly </button>
                                        <button type="button" class="btn btn-secondary btn-vote">Moderately</button>
                                        <button type="button" class="btn btn-secondary btn-vote">Quite a lot</button>
                                        <button type="button" class="btn btn-secondary btn-vote">Totally</button>
                                    </div>
                                </div>
                            </div> </a>
                        <a href="#" class="list-group-item list-group-item-action"> <div class="d-flex w-100 justify-content-between">
                                <h4 class="mb-1">Channel News Asia </h4>
                                <small>3 days ago</small>
                            </div> <img src="https://images.unsplash.com/photo-1508964942454-1a56651d54ac?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjIwOTIyfQq=85&fm=jpg&crop=faces&cs=srgb&w=400&h=200&fit=crop" class="article_image img-fluid rounded-lg"><h6 class="text-uppercase"><p>Goh Chok Tong not running in GE2020, retiring as MP but not from politics</p></h6><p class="mb-1 card-text">  Goh said that he will not have the same energy when he reaches his 80s.</p><div class="card-footer">
                                <div style="margin-top: 15px;"> 
                                    <label>How biased do you think this article and headline are?</label>
                                    <div class="btn-group btn-group-sm d-flex text-center" role="group" aria-label="Small button group">
                                        <button type="button" class="btn btn-secondary btn-vote">Very Negative</button>
                                        <button type="button" class="btn btn-secondary btn-vote">Slightly -</button>
                                        <button type="button" class="btn btn-secondary btn-vote">Neutral</button>
                                        <button type="button" class="btn btn-secondary btn-vote">Slightly +</button>
                                        <button type="button" class="btn btn-secondary btn-vote">Very Positive</button>
                                    </div>
                                </div>
                                <div style="margin-top: 15px;"> 
                                    <label>How much would you trust this article?</label>
                                    <div class="btn-group btn-group-sm d-flex text-center" role="group" aria-label="Small button group">
                                        <button type="button" class="btn btn-secondary btn-vote">Not at all</button>
                                        <button type="button" class="btn btn-secondary btn-vote">Slightly </button>
                                        <button type="button" class="btn btn-secondary btn-vote">Moderately</button>
                                        <button type="button" class="btn btn-secondary btn-vote">Quite a lot</button>
                                        <button type="button" class="btn btn-secondary btn-vote">Totally</button>
                                    </div>
                                </div>
                            </div> </a>
                        <a href="#" class="list-group-item list-group-item-action"> <div class="d-flex w-100 justify-content-between">
                                <h4 class="mb-1"><h3>All Singapore Stuff</h3></h4>
                                <small>3 days ago</small>
                            </div> <h6 class="text-uppercase"><h6>PM LEE RUNNING AWAY WITH OUR CPF!</h6></h6><p class="mb-1 card-text">This is the excerpt of the article. A wider card with supporting text below as a natural lead-in to additional content....</p><small>Donec id elit non mi porta.</small><div class="card-footer">
                                <div style="margin-top: 15px;"> 
                                    <label>How biased do you think this article and headline are?</label>
                                    <div class="btn-group btn-group-sm d-flex text-center" role="group" aria-label="Small button group">
                                        <button type="button" class="btn btn-secondary btn-vote">Very Negative</button>
                                        <button type="button" class="btn btn-secondary btn-vote">Slightly -</button>
                                        <button type="button" class="btn btn-secondary btn-vote">Neutral</button>
                                        <button type="button" class="btn btn-secondary btn-vote">Slightly +</button>
                                        <button type="button" class="btn btn-secondary btn-vote">Very Positive</button>
                                    </div>
                                </div>
                                <div style="margin-top: 15px;"> 
                                    <label>How much would you trust this article?</label>
                                    <div class="btn-group btn-group-sm d-flex text-center" role="group" aria-label="Small button group">
                                        <button type="button" class="btn btn-secondary btn-vote">Not at all</button>
                                        <button type="button" class="btn btn-secondary btn-vote">Slightly </button>
                                        <button type="button" class="btn btn-secondary btn-vote">Moderately</button>
                                        <button type="button" class="btn btn-secondary btn-vote">Quite a lot</button>
                                        <button type="button" class="btn btn-secondary btn-vote">Totally</button>
                                    </div>
                                </div>
                                <button type="submit" class="border-dark btn btn-block btn-outline-dark btn-primary font-weight-bold mt-2 text-light text-uppercase">SUBMIT</button>
                            </div> </a>
                    </div>
                    <a class="border border-primary btn btn-block btn-light btn-outline-dark text-primary text-uppercase" href="#">Go to next Spin >></a>
                </div>
                <div class="col-md-4 offset-md-1">
                    <h3>List of All Spins</h3>
                    <hr/> 
                    <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                    <table class="table"> 
                        <thead> 
                            <tr> 
                                <th>Issue</th>
                                <th>Date</th> 
                                <th>Spins (#)</th> 
                            </tr>                             
                        </thead>                         
                        <tbody> 

<?php


// get results 
$range = 'issues!A2:D999';
$response = $service->spreadsheets_values->get($spreadsheetId, $range);
$issues = $response->getValues();
if (empty($issues)) {
print 'No data found.\n';
} else {
    foreach ($issues as $issue) {
        ?>
               
                            <tr> 
                                <td><?php echo $issue[2]; ?></td> 
                                <td><?php echo $issue[1]; ?></td> 
                                <td>9</td> 
                            </tr>     

<?php         
    }
}
?>  

                    
                        </tbody>                         
                    </table>                     
                </div>
            </div>
            <hr>
            <footer>
                <p class="text-center">&copy; <a href="https://better.sg" target="_blank">Better.sg</a> 2020</p>
            </footer>
        </div>         
        <!-- /container -->
        <!-- Bootstrap core JavaScript
    ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/popper.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>