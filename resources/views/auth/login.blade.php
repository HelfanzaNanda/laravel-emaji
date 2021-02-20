<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>E-Maji</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">


  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
</head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
                <h5 class="text-primary"><strong>E MAJI</strong></h5>
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4>Login</h4></div>

              <div class="card-body">
                <form id="login-form" method="POST" action="#" >
                    @csrf
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input  type="email" class="form-control" name="email" tabindex="1" autofocus>
                    <span class="text-danger error-email"></span>
                  </div>

                  <div class="form-group">
                    <label for="password" class="control-label">Password</label>
                    <input type="password" class="form-control" name="password" tabindex="2">
                    <span class="text-danger error-password"></span>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary loading btn-block" tabindex="4"
                    data-loading-text='<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Loading...'>
                        Submit
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  
  <x-script/>
  <x-loading/>
  <x-ajax/>

  <script>
       $('form#login-form').submit( async function( e ) {
        e.preventDefault();
        setLoading();

        var form_data = new FormData( this );
        var url = BASE_URL+'/login';
        var response = await createOrUpdate(url, form_data);
        if(response.status == 'success') {
            alertSuccess(response.message, response.url);
        } else {
            hideLoading()
            alertError(response.message);
            
        }
    });
  </script>


  <x-ajax/>
</body>
</html>
