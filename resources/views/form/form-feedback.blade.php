@extends('layout.app')
@section('description')
    <meta name="description" content="This is laravel test" />
@stop

@section('title')
    <title>User's Feedback</title>
@stop

@section('style')
    <style type="text/css" media="screen">
        
    </style>
@stop

@section('content')
    <div class="main-container">
        <form action="" id="user_feedback" method="POST"  role="form">
            <div class="form-container">
                <h2>How can we help you?</h2>
                <div class="form-row">
                    <div class="form-group">
                        <div class="form-input border-right">
                            <input class="input " id="name" name="name" type="text" >
                            <label>Name</label>
                        </div>
                        <div class="form-input">
                            <input class="input"  id="email"  name="email" type="email" >
                            <label>Email <small class="alert alert-danger" style="display:none"></small> </label>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <div class="form-input border-right">
                            <input class="input" name="company" id="company" type="text" >
                            <label>Company</label>
                        </div>
                        <div class="form-input">
                            <input class="input" name="phone_number" id="phone_number" type="text"  >
                            <label>Phone number</label>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-input">
                        
                        <input class="input" name="subject" id="subject" type="text"  >
                        <label>Subject</label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-input">
                        <textarea class="text-area" name="message" id="message"  ></textarea>
                        <label for="">Message</label>
                    </div>
                </div>
                <div class="btn-container">
                    <button type="submit" class="btn">Send</button>
                </div>

            </div>
        </form>
    </div>
    <div class="form-end-layer">
        <div class="form-layer-content">
            <img src="{{asset('img/icon.png')}}" alt="">
            <h2>Thank you for getting in touch!</h2>
            <h3>we will get back to you soon!</h3>
        </div>
    </div>
@stop
@section('scripts')
<script src="//code.jquery.com/jquery.js"></script>
    <script type="text/javascript">
        $("#user_feedback").submit(function(stay){
            var checkvalidation = false;
            $('input[type=text]').each(function(){
               var id = $(this);
                if ($(id).val()=='') 
                { 
                    $(this).addClass('invalid');
                    checkvalidation = true;
                }
            })
            var email = $('#email').val();
            if (email=='') 
            { 
                $('#email').addClass('invalid');
                checkvalidation = true;
            }
            if (checkvalidation == true) 
            {
                return false;
            }
            jQuery.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
            });
            var formdata = $(this).serialize(); // here $(this) refere to the form its submitting
            $.ajax({
                type: 'POST',
                url: "{{route('UserFeedback') }}",
                data: formdata, // here $(this) refers to the ajax object not form
                success: function (data) {

                    if (data.success) 
                    {
                        $('.form-end-layer').css('display','flex');
                    }
                    else
                    {
                        jQuery.each(data.errors, function(key, value){
                        jQuery('.alert-danger').show();
                        jQuery('.alert-danger').html('<p>'+value+'</p>');
                        
                        });
                    }                    
                },
            });
            stay.preventDefault(); 
        });
    </script>
@stop