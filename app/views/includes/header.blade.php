    <div id="title-bar-wrapper">
        <div class="container" id="title-bar">
             <a href="{{URL::to('/')}}"><img src="{{URL::to('res/images/ics_logo.jpg')}}"></a>
            <h2 id="site-title">INSTITUTE OF COMPUTER SCIENCE</h2>
        </div>
    </div>
    <nav class="navbar navbar-default" id="navigation-menu">
        <div class="container">
            <div class="navbar-header" id="site-name">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>

              <a class="navbar-brand" href="{{URL::to('/')}}">ICS UPLB</a>

            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="{{URL::to('/')}}">Home</a></li>
                    <li><a href="{{URL::to('pages/publication')}}">News</a></li>
                    <li><a href="{{URL::to('pages/library')}}">Library</a></li>
                    <li><a href="{{URL::to('pages/directory')}}">Faculty</a></li>
                    <li><a href="{{URL::to('pages/curriculum')}}">Courses</a></li>
                    <li><a href="{{URL::to('pages/division')}}">Divisions</a></li>
                    <li><a href="{{URL::to('pages/about')}}">About Us</a></li>
                </ul>
                <?php
                   if (Session::has('username')){
                ?>  
                        <ul class="nav navbar-nav navbar-right">
                        <li> <?php if($type=='student'){ ?><a id="username" href="{{URL::to('pages/group')}}"><?php }else{ ?><a id="username" href="{{URL::to('pages/profile')}}" ><?php } ?><?php echo $username; ?></a></li>
                        <li><a href="{{URL::to('pages/users/logout')}}"><span class="glyphicon glyphicon-user"></span> Log out</a></li> 
                        </ul>
                        {{ Form::hidden('userType',Session::get('type'),array('id'=>'userType')) }}

                <?php
                    }else{
                ?>
                        <ul class="nav navbar-nav navbar-right">
                        <li id="register-toggle"><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                        <li id="login-toggle"><a href="{{URL::to('pages/users/login')}}"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                        </ul>
                <?php    }

                ?> 
            </div>

            <div id="register-field" class="col-md-12">
                <div id="register-field-content">
                <center>
                    <h5>REGISTER to ICS Portal</h5>
                    <button class="btn register-button" id="register-student">
                    <a href="{{URL::to('pages/create/student')}}">Student</a></button>
                    <br>
                    <button class="btn register-button" id="register-faculty">
                    <a href="{{URL::to('pages/create/faculty')}}">Faculty</a></button>
                </center>
                </div>
            </div>

        </div>
    </nav>

