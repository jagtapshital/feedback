@extends('layouts.app')
@section('content')
    
    <div class="container">
        <div class="row justify-content-center " style="padding-top:60px !important;">
          <div class="col-md-8">
          <div class="card-group" >
            <div class="card  pt-0 card-shadow">
              <div class="card-body" style="">
                <p class="text-center"><h2>Feedback Form</h2></p>   
                <form id="createFeedbackForm" method="post" class="form-bordered" onsubmit="return false;" enctype="multipart/form-data">
                    {{ csrf_field() }} 
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input type="hidden" id="country" name="country">
                                                <label class="label">Name</label> <span class="invalid_input">*</span>
                                                <input id="name" name="name"  class="form-control" placeholder="Enter your name" style="border-radius: 15px;" required/>
                                            </div>                         
                                        </div>                                
                                    </div>                                      
                                </div>        
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="label">State</label> <span class="invalid_input">*</span>
                                                <select  class="form-control" id="state" name="state" style="border-radius: 15px;" onchange="selectedCity($('#state option:selected').val())"></select>
                                            </div>                         
                                            <div class="col-md-6">
                                                <label class="label">City</label> <span class="invalid_input">*</span>
                                                <select  class="form-control" id="city" name="city" style="border-radius: 15px;" ></select>
                                            </div>                         
                                        </div>                                
                                    </div>                                      
                                </div>        
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label class="label">Feedback</label> <span class="invalid_input">*</span>
                                                <textarea id="feedback_message" name="feedback_message" rows="2" class="form-control" placeholder="Enter Feedback" maxlength="100" style="border-radius: 15px;" required></textarea>
                                            </div>
                                            
                                        </div>
                                    </div>                                      
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-md-12 pb-0">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <span id="error" class="text-danger pull-left Bold hidden"></span>
                                        <button id="submitFeedbackBtn" class="btn btn-primary pull-right">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>    
              </div>
            
            </div>
          </div>
        </div>
      </div>
    </div> 
    
    @endsection

    @section('javascript')
    <script>
       var country= {!! json_encode($country) !!};
        document.getElementById("country").value = country;
         selectedState();
        function selectedState() {
        $('#state option').remove();
        // var country= 'India';
        // console.log(country);
            $.ajax({
                    type: 'GET',
                    url: '/stateList?country_name='+country,
                success:function(response) {
                    $('#state').empty();
                    $.each(response,function(key,val){
                        $('<option value="'+ val.name +'">' + val.name+ '</option>').appendTo('#state');
                    });
                    selectedCity(state[0].value);
                }
                });
            }
        function selectedCity(state) {
        $('#city option').remove();
            $.ajax({
                    type: 'GET',
                    url: '/cityList?state_name='+state,
                success:function(response) {
                    $('#city').empty();
                    $.each(response,function(key,val){
                        $('<option value="'+ val.name +'">' + val.name+ '</option>').appendTo('#city');
                    });
                }
                });
            }
           $("#submitFeedbackBtn").click(function (e) {
            e.preventDefault();
                fdata = $('#createFeedbackForm').serialize();
                $("#createFeedbackForm :input").prop("disabled", true);
    
                $(this).addClass('disabled');
                $('#error').addClass('hidden');
                $('#loadingBtn').removeClass('hidden');
                $('#submitFeedbackBtn').addClass('hidden');
                 $.ajax({
                    type: 'POST',
                    url: '{{route('feedback.store')}}',
                    data: fdata,
                    success: function (response) {
                        if (response.status) 
                        {
                            alert(response.message)
                            $('#error').removeClass('hidden');
                            $('#loadingBtn').addClass('hidden');
                            $('#submitFeedbackBtn').removeClass('hidden');
                            $("#createFeedbackForm :input").prop("disabled", false);	
                            document.getElementById("createFeedbackForm").reset();	
    
                        } else {
                            $('#error').html('');
                            $('#error').removeClass('hidden').html(response.message);
                            $('#loadingBtn').addClass('hidden');
                            $('#submitFeedbackBtn').removeClass('hidden');
                            $("#createFeedbackForm :input").prop("disabled", false);	
                        }
    
                    }
                });
            
            });
    </script>
    @endsection
<style>
  .center-card {
  margin: 0;
   position: absolute;
   top: 50%;
   left: 50%;
   margin-right: -50%;
   transform: translate(-50%, -50%);
   padding-left:15px !important;padding-right:15px !important
}
</style>
