
	<div class="col-md-4">
		<div class="card my-4">
          <h5 class="card-header">Archives</h5>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-6">
                <ul class="list-unstyled mb-0">
                  @foreach($archives as $arch)
                    <li><a href="/?month={{$arch->month}}&year={{$arch->year}}">{{$arch->month .' '.$arch->year }}</a></li>
                  @endforeach
                </ul>
              </div>
              {{-- <div class="col-lg-6">
                <ul class="list-unstyled mb-0">
                  <li>
                    <a href="#">JavaScript</a>
                  </li>
                  <li>
                    <a href="#">CSS</a>
                  </li>
                  <li>
                    <a href="#">Tutorials</a>
                  </li>
                </ul>
              </div> --}}
            </div>
          </div>
        </div>
	</div>
	
