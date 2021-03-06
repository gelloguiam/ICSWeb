@extends('layouts.default')
@section('content')

<title>Sign Up as Student</title>

	<div class="wrapping-panel" id="reg-form-panel">
		<div class="container">
			<div class="col-md-12">
			<div class="col-md-8" id="registration-form-panel">
				<div class="col-md-12" id="reg-form-title">
				<h2>ICS Student Register Form</h2>
				
				</div>
				<div class="col-md-12" id="reg-form-body">
				{{ Form::open(array('route'=>'pages.user.store', 'name'=>'reg-form', 'id'=>'reg-form'))}}

					{{ Form::macro('regInput', function($inputType, $idName, $placeholderValue, $labelValue)
						{
							echo Form::label($idName, $labelValue);
							if($idName == 'studentNumber') echo Form::input($inputType, $idName, '' , array('maxlength'=>'10','id'=>$idName,'class'=>'form-control','placeholder'=>$placeholderValue));
							else echo Form::input($inputType, $idName, '' , array('id'=>$idName,'class'=>'form-control','placeholder'=>$placeholderValue));
							echo '<br>';
						});
					}}
					{{ Form::regInput('text','firstName','Enter your first name here','First Name') }}
					{{ Form::regInput('text','middleName','Enter your middle name here','Middle Name') }}
					{{ Form::regInput('text','lastName','Enter your last name here','Last Name') }}
					{{ Form::regInput('date','birthdate', 'YYYY-MM-DD', 'Birthdate') }}

					{{ Form::label('sex',"Sex")}}
					<br>
					{{ Form::radio('sex', 'male') }} Male
					<br>
					{{ Form::radio('sex', 'female') }} Female
					<br><br>

					{{ Form::regInput('email','email','Enter a valid email address','E-mail Address') }}
					{{ Form::regInput('text','username','Enter your username','Username') }}
					{{ Form::regInput('password','password','Make this password secure','Password') }}
					{{ Form::regInput('password','retypePassword','Retype your password','Retype Password') }}
					<div id="error-message"></div>
					{{ Form::regInput('text','studentNumber','XXXX-XXXXX','Student Number') }}
					<div id="error-message-studNum"></div>
					{{ Form::hidden('employeeNumber', NULL, array('id'=>'employeeNumber')) }}
					{{ Form::hidden('room', NULL, array('id'=>'room')) }}
					{{ Form::hidden('academicPosition', NULL, array('id'=>'academicPosition')) }}
					{{ Form::hidden('type', 'student', array('id'=>'type')) }}
					
					<div id="valid" class="btn btn-primary">Submit</div>

				</div>

			</div>
			<div class="col-md-4" id="welcome-text-panel">
			<h2 id="welcome-text">WELCOME to ICS Portal!</h2>
			<p>ICS has strong undergraduate and graduate (Diploma, MIT, MS and PhD) degree programs in computer science and information technology with more than 30 faculty members, and about 600 students. We are committed to excellence in teaching, research, and extension.</p>
			<p>Home to the first and only Academician in Computer Science.</p>
			<span>
				<hr>
				<span class="fa fa-quote-left"></span>
				<p id="quote-text">Everyone in this country should know how to program, because it teaches you how to think.</p>
				<span class="fa fa-quote-right"></span>
				<p id="quote-author">- Steve Jobs<p>
				<hr>
			</span>
			</div>
			</div>
		</div>
	</div>

	<div id="dimmer" class="col-md-12"></div>

	<div id="pop-up">
		<div class="col-md-12">
			<span class="glyphicon glyphicon-ok"></span>
			<div>THANK YOU FOR REGISTERING</div>
				{{ Form::submit('Close', array('id'=>'close-pop','class'=>'btn btn-default')) }}
		</div>
	</div>

				{{ Form::close() }}


@stop