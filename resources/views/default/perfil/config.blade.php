@extends('home.index')

@section('titulo', auth()->user()->nome)

@section('conteudo')
    <div id="dadoPrincipal">
        <div class="row">
            <div class="col-xl-3 col-lg-4">
                  <div class="card">
                     <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                           <h4 class="card-title">Add New User</h4>
                        </div>
                     </div>
                     <div class="card-body">
                        <form>
                           <div class="form-group">
                              <div class="crm-profile-img-edit position-relative">
                                 <img class="crm-profile-pic rounded avatar-100" src="{{ assetr('assets/images/user/11.png')}}" alt="profile-pic">
                                 <div class="crm-p-image bg-primary">
                                    <i class="las la-pen upload-button"></i>
                                    <input class="file-upload" type="file" accept="image/*">
                                 </div>
                              </div>
                           <div class="img-extension mt-3">
                              <div class="d-inline-block align-items-center">
                                    <span>Only</span>
                                 <a href="javascript:void();">.jpg</a>
                                 <a href="javascript:void();">.png</a>
                                 <a href="javascript:void();">.jpeg</a>
                                 <span>allowed</span>
                              </div>
                           </div>
                           </div>
                           <div class="form-group">
                              <label>User Role:</label>
                              <div class="dropdown bootstrap-select form-control dropup"><select name="type" class="selectpicker form-control" data-style="py-0" tabindex="null">
                                 <option>Select</option>
                                 <option>Web Designer</option>
                                 <option>Web Developer</option>
                                 <option>Tester</option>
                                 <option>Php Developer</option>
                                 <option>Ios Developer </option>
                              </select><button type="button" tabindex="-1" class="btn dropdown-toggle py-0" data-toggle="dropdown" role="combobox" aria-owns="bs-select-1" aria-haspopup="listbox" aria-expanded="false" title="Ios Developer"><div class="filter-option"><div class="filter-option-inner"><div class="filter-option-inner-inner">Ios Developer</div></div> </div></button><div class="dropdown-menu" style="max-height: 355.656px; overflow: hidden; min-height: 179px;"><div class="inner show" role="listbox" id="bs-select-1" tabindex="-1" aria-activedescendant="bs-select-1-5" style="max-height: 337.656px; overflow-y: auto; min-height: 161px;"><ul class="dropdown-menu inner show" role="presentation" style="margin-top: 0px; margin-bottom: 0px;"><li class=""><a role="option" class="dropdown-item" id="bs-select-1-0" tabindex="0" aria-setsize="6" aria-posinset="1"><span class="text">Select</span></a></li><li><a role="option" class="dropdown-item" id="bs-select-1-1" tabindex="0"><span class="text">Web Designer</span></a></li><li><a role="option" class="dropdown-item" id="bs-select-1-2" tabindex="0"><span class="text">Web Developer</span></a></li><li><a role="option" class="dropdown-item" id="bs-select-1-3" tabindex="0" aria-setsize="6" aria-posinset="4"><span class="text">Tester</span></a></li><li class="selected active"><a role="option" class="dropdown-item active selected" id="bs-select-1-4" tabindex="0" aria-setsize="6" aria-posinset="5" aria-selected="true"><span class="text">Php Developer</span></a></li><li class="selected active"><a role="option" class="dropdown-item active selected" id="bs-select-1-5" tabindex="0" aria-setsize="6" aria-posinset="6" aria-selected="true"><span class="text">Ios Developer </span></a></li></ul></div></div></div>
                           </div>
                           <div class="form-group">
                              <label for="furl">Facebook Url:</label>
                              <input type="text" class="form-control" id="furl" placeholder="Facebook Url">
                           </div>
                           <div class="form-group">
                              <label for="turl">Twitter Url:</label>
                              <input type="text" class="form-control" id="turl" placeholder="Twitter Url">
                           </div>
                           <div class="form-group">
                              <label for="instaurl">Instagram Url:</label>
                              <input type="text" class="form-control" id="instaurl" placeholder="Instagram Url">
                           </div>
                           <div class="form-group">
                              <label for="lurl">Linkedin Url:</label>
                              <input type="text" class="form-control" id="lurl" placeholder="Linkedin Url">
                           </div>
                        </form>
                     </div>
                  </div>
            </div>
            <div class="col-xl-9 col-lg-8">
                  <div class="card">
                     <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                           <h4 class="card-title">New User Information</h4>
                        </div>
                     </div>
                     <div class="card-body">
                        <div class="new-user-info">
                           <form>
                              <div class="row">
                                 <div class="form-group col-md-6">
                                    <label for="fname">First Name:</label>
                                    <input type="text" class="form-control" id="fname" placeholder="First Name">
                                 </div>
                                 <div class="form-group col-md-6">
                                    <label for="lname">Last Name:</label>
                                    <input type="text" class="form-control" id="lname" placeholder="Last Name">
                                 </div>
                                 <div class="form-group col-md-6">
                                    <label for="add1">Street Address 1:</label>
                                    <input type="text" class="form-control" id="add1" placeholder="Street Address 1">
                                 </div>
                                 <div class="form-group col-md-6">
                                    <label for="add2">Street Address 2:</label>
                                    <input type="text" class="form-control" id="add2" placeholder="Street Address 2">
                                 </div>
                                 <div class="form-group col-md-12">
                                    <label for="cname">Company Name:</label>
                                    <input type="text" class="form-control" id="cname" placeholder="Company Name">
                                 </div>
                                 <div class="form-group col-sm-12">
                                    <label>Country:</label>
                                    <div class="dropdown bootstrap-select form-control"><select name="type" class="selectpicker form-control" data-style="py-0">
                                       <option>Select Country</option>
                                       <option>Caneda</option>
                                       <option>Noida</option>
                                       <option>USA</option>
                                       <option>India</option>
                                       <option>Africa</option>
                                    </select><button type="button" tabindex="-1" class="btn dropdown-toggle py-0" data-toggle="dropdown" role="combobox" aria-owns="bs-select-2" aria-haspopup="listbox" aria-expanded="false" title="Select Country"><div class="filter-option"><div class="filter-option-inner"><div class="filter-option-inner-inner">Select Country</div></div> </div></button><div class="dropdown-menu "><div class="inner show" role="listbox" id="bs-select-2" tabindex="-1"><ul class="dropdown-menu inner show" role="presentation"></ul></div></div></div>
                                 </div>
                                 <div class="form-group col-md-6">
                                    <label for="mobno">Mobile Number:</label>
                                    <input type="text" class="form-control" id="mobno" placeholder="Mobile Number">
                                 </div>
                                 <div class="form-group col-md-6">
                                    <label for="altconno">Alternate Contact:</label>
                                    <input type="text" class="form-control" id="altconno" placeholder="Alternate Contact">
                                 </div>
                                 <div class="form-group col-md-6">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" id="email" placeholder="Email">
                                 </div>
                                 <div class="form-group col-md-6">
                                    <label for="pno">Pin Code:</label>
                                    <input type="text" class="form-control" id="pno" placeholder="Pin Code">
                                 </div>
                                 <div class="form-group col-md-12">
                                    <label for="city">Town/City:</label>
                                    <input type="text" class="form-control" id="city" placeholder="Town/City">
                                 </div>
                              </div>
                              <hr>
                              <h5 class="mb-3">Security</h5>
                              <div class="row">
                                 <div class="form-group col-md-12">
                                    <label for="uname">User Name:</label>
                                    <input type="text" class="form-control" id="uname" placeholder="User Name">
                                 </div>
                                 <div class="form-group col-md-6">
                                    <label for="pass">Password:</label>
                                    <input type="password" class="form-control" id="pass" placeholder="Password">
                                 </div>
                                 <div class="form-group col-md-6">
                                    <label for="rpass">Repeat Password:</label>
                                    <input type="password" class="form-control" id="rpass" placeholder="Repeat Password ">
                                 </div>
                              </div>
                              <div class="checkbox">
                                 <label><input class="mr-2" type="checkbox">Enable Two-Factor-Authentication</label>
                              </div>
                              <button type="submit" class="btn btn-primary">Add New User</button>
                           </form>
                        </div>
                     </div>
                  </div>
            </div>
         </div>
    </div>
@endsection
