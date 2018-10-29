 
 <div class="inner-serch-bar">
        <div class="container">
          <div class="row">
            <div class="col-sm-12">
              <div class="input-group md-form form-sm form-2 pl-0">
                <form action="{{url('research-reports')}}">
                <input class="form-control my-0 py-1 amber-border" value="{{$categoryName or ''}}" type="text" name="search" placeholder="Search Your Keywords..." aria-label="Search" style="height: 42px">
                <div class="input-group-append"> 
                  <button type="submit" class="single_add_to_cart_button btn btn-danger alt">Search</button>
                </div>
             </form>

              </div>
            </div>
          </div>
        </div>
      </div>