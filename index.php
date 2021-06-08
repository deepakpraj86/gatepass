<!doctype html>
<html lang="en">
    <?php
       $link = mysqli_connect('database-1.cduqttbxoz9l.ap-south-1.rds.amazonaws.com','admin','Deep#6922','GatePassDB');
       if(!$link){
          print("Connection to the Databse failed..!");
       }
    ?>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/11.0.2/bootstrap-slider.min.js" integrity="sha512-f0VlzJbcEB6KiW8ZVtL+5HWPDyW1+nJEjguZ5IVnSQkvZbwBt2RfCBY0CBO1PsMAqxxrG4Di6TfsCPP3ZRwKpA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/11.0.2/css/bootstrap-slider.min.css" integrity="sha512-3q8fi8M0VS+X/3n64Ndpp6Bit7oXSiyCnzmlx6IDBLGlY5euFySyJ46RUlqIVs0DPCGOypqP8IRk/EyPvU28mQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Gate Pass App</title>
  </head>
  <body>
    <div class="col-lg-6 mx-auto">
        <h2 align="center">New Pass</h2>
        <form class="needs-validation" novalidate action="genPass.php" method="POST">
            <div class="form-row">
                <div class="col-md-6 mb-2">
                    <label>Sl#</label><span id="sl_no" class="text-danger font-weight-bold">
                      <?php
                        $data=mysqli_query($link,"select sl_no from Passes order by sl_no desc limit 1;");
                        $row=mysqli_fetch_row($data);
                        echo ($row[0]+1);
                      ?>
                    </span>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-12 mb-2">
                    <span class="font-weight-bold">Staff's Details</span>
                </div>
              <div class="col-md-12 mb-2">
                <label for="staff_name">Name</label>
                <input type="text" class="form-control" name="staff_name" id="staff_name" onchange="copyName()"  placeholder="Employee Name" required>
                <div class="invalid-feedback">
                  Name is required
                </div>
              </div>
              <div class="col-md-6 mb-2">
                <label for="staff_id">Emp #</label>
                <input type="text" class="form-control" name="staff_id" id="staff_id" onkeypress="return EmpId(event)" placeholder="Emp ID" required>
                <div class="invalid-feedback">
                  Emp ID is required
                </div>
              </div>
              <div class="col-md-6 mb-2">
                <label for="mob_no">Mobile</label>
                <input type="number" class="form-control" name="mob_no" id="mob_no" onkeypress="return MobNum(event)"
                maxlength="11" placeholder="Mobile No." required>
                <div class="invalid-feedback">
                  Mobile is required
                </div>
              </div>
              <div class="col-md-12 mb-2">
                  <hr>
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-12 mb-5">
                <label for="time_out">Time Out</label>
                <input type="time" class="form-control" name="time_out" onchange="updateTime()" id="time_out" required>
                <div class="invalid-feedback">
                  Time Out is required
                </div>
              </div>
              <div class="col-md-12 mb-2">
                <div class="mx-auto text-center">
                    <label for="validationCustom03">Duration</label>
                    <input id="ex6" type="text" data-slider-min="5" data-slider-max="180" data-slider-step="5" data-slider-value="5"/>
                    <span id="ex6CurrentSliderValLabel"> &nbsp;&nbsp;<span id="ex6SliderVal">5 Minutes</span></span>
                </div>
              </div>
              <div class="col-md-12 mb-3">
                <label for="time_in">Time In</label>
                <input type="time" class="form-control" name="time_in" value="00:00" id="time_in" required>
                <div class="invalid-feedback">
                  Time In is required
                </div>
              </div>
            </div>

            <div class="form-row">
                <div class="col-md-6 mb-4">
                    <label for="req_by">Requested By</label>
                    <input type="text" class="form-control" name="req_by" id="req_by" >
                </div>
                <div class="col-md-6 mb-4">
                    <label for="app_by">Approved By</label>
                    <input type="text" class="form-control" name="app_by" value="Vinod Vijayan" id="app_by" >
                </div>
            </div>
            <div class="col-md-12 mb-2 text-center">
                <button class="btn btn-primary" type="submit">Generate E-Pass</button>
            </div>
          </form>
          
          <script>
          // Example starter JavaScript for disabling form submissions if there are invalid fields
          (function() {
            'use strict';
            window.addEventListener('load', function() {
              // Fetch all the forms we want to apply custom Bootstrap validation styles to
              var forms = document.getElementsByClassName('needs-validation');
              // Loop over them and prevent submission
              var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                  if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                  }
                  form.classList.add('was-validated');
                }, false);
              });
            }, false);
          })();
          function MobNum(evt) 
          {
            var ASCIICode = (evt.which) ? evt.which : evt.keyCode;
            if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
            {
                return false;
            }
            else
            {   
                if(evt.target.value.length<=9)
                    return true;
                else
                    return false;
            }
          }
          function EmpId(evt) 
          {
            var ASCIICode = (evt.which) ? evt.which : evt.keyCode;
            if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
            {
                return false;
            }
            else
            {   
                if(evt.target.value.length<=5)
                    return true;
                else
                    return false;
            }
          }
          var slider = new Slider("#ex6",{tooltip:'always'});
            slider.on("slide", function(sliderValue) {
                let hrs=parseInt(sliderValue/60);
                let mnts=sliderValue-(hrs*60);
                if(hrs>0)
                    document.getElementById("ex6SliderVal").textContent = hrs+" Hrs & "+mnts+" Mnts";
                else
                    document.getElementById("ex6SliderVal").textContent = mnts+" Minutes";
                    updateTime();
            });
            function updateTime()
            {
                let time_out=document.getElementById('time_out').value;
                let duration=parseInt(document.getElementById('ex6').value);
                let time_out_split=time_out.split(':');
                let time_out_hrs=parseInt(time_out_split[0]);
                let time_out_ms=parseInt(time_out_split[1]);
                let hrs1=parseInt(duration/60);
                let mnts1=duration-(hrs1*60);
                let time_in_hrs=time_out_hrs+hrs1;
                let time_in_mnts=time_out_ms+mnts1;
                if(time_in_mnts>=60)
                {
                    time_in_hrs=time_in_hrs+parseInt(time_in_mnts/60);
                    time_in_mnts=time_in_mnts-(parseInt(time_in_mnts/60)*60);
                }
                if(time_in_hrs>=24)
                {
                    time_in_hrs=time_in_hrs-24;
                }
                tim=(time_in_mnts<10)?'0'+time_in_mnts:time_in_mnts;
                tih=(time_in_hrs===0 || time_in_hrs<10 )?'0'+time_in_hrs:time_in_hrs;
                let time_in=tih+':'+tim; //alert(time_in);
                //alert('time_out : '+time_out+'\n duration : '+duration+'\n time_in : '+time_in);
                document.getElementById('time_in').value=time_in;
            }
            function copyName()
            {
                let sname=document.getElementById('staff_name').value;
                document.getElementById('req_by').value=sname;
            }
          </script>
        </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>