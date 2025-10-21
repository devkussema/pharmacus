@extends('admin::layout.main')

@section('title', 'Cadastrar Usuário')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <form>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-heading">
                                <h4>Cadastrar Usuário</h4>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-xl-4">
                            <div class="input-block local-forms">
                                <label>Nome <span class="login-danger">*</span></label>
                                <input class="form-control" type="text" placeholder>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-xl-4">
                            <div class="input-block local-forms">
                                <label>Sobrenome <span class="login-danger">*</span></label>
                                <input class="form-control" type="text" placeholder>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-xl-4">
                            <div class="input-block local-forms">
                                <label>Nome de usuário <span class="login-danger">*</span></label>
                                <input class="form-control" type="text" placeholder>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-xl-6">
                            <div class="input-block local-forms">
                                <label>Telefone <span class="login-danger">*</span></label>
                                <input class="form-control" type="text" placeholder>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-xl-6">
                            <div class="input-block local-forms">
                                <label>Email <span class="login-danger">*</span></label>
                                <input class="form-control" type="email" placeholder>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-xl-6">
                            <div class="input-block local-forms">
                                <label>Password <span class="login-danger">*</span></label>
                                <input class="form-control" type="password" placeholder>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-xl-6">
                            <div class="input-block local-forms">
                                <label>Confirm Password <span class="login-danger">*</span></label>
                                <input class="form-control" type="password" placeholder>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-xl-6">
                            <div class="input-block local-forms cal-icon">
                                <label>Date Of Birth <span class="login-danger">*</span></label>
                                <input class="form-control datetimepicker" type="text" placeholder>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-xl-6">
                            <div class="input-block select-gender">
                                <label class="gen-label">Gender<span
                                        class="login-danger">*</span></label>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" name="gender"
                                            class="form-check-input mt-0">Male
                                    </label>
                                </div>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" name="gender"
                                            class="form-check-input mt-0">Female
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-xl-4">
                            <div class="input-block local-forms">
                                <label>Education <span class="login-danger">*</span></label>
                                <input class="form-control" type="text" placeholder>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-xl-4">
                            <div class="input-block local-forms">
                                <label>Designation <span class="login-danger">*</span></label>
                                <input class="form-control" type="text" placeholder>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-xl-4">
                            <div class="input-block local-forms">
                                <label>Department <span class="login-danger">*</span></label>
                                <select class="form-control select">
                                    <option>Select Department</option>
                                    <option>Orthopedics</option>
                                    <option>Radiology</option>
                                    <option>Dentist</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12">
                            <div class="input-block local-forms">
                                <label>Address <span class="login-danger">*</span></label>
                                <textarea class="form-control" rows="3" cols="30"></textarea>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-xl-3">
                            <div class="input-block local-forms">
                                <label>City <span class="login-danger">*</span></label>
                                <select class="form-control select">
                                    <option>Select City</option>
                                    <option>Alaska</option>
                                    <option>Los Angeles</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-xl-3">
                            <div class="input-block local-forms">
                                <label>Country <span class="login-danger">*</span></label>
                                <select class="form-control select">
                                    <option>Select Country </option>
                                    <option>Usa</option>
                                    <option>Uk</option>
                                    <option>Italy</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-xl-3">
                            <div class="input-block local-forms">
                                <label>State/Province <span class="login-danger">*</span></label>
                                <select class="form-control select">
                                    <option>Select State</option>
                                    <option>Alaska</option>
                                    <option>California</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-xl-3">
                            <div class="input-block local-forms">
                                <label>Postal Code <span class="login-danger">*</span></label>
                                <input class="form-control" type="text" placeholder>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12">
                            <div class="input-block local-forms">
                                <label>Start Biography <span class="login-danger">*</span></label>
                                <textarea class="form-control" rows="3" cols="30"></textarea>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-xl-6">
                            <div class="input-block local-top-form">
                                <label class="local-top">Avatar <span
                                        class="login-danger">*</span></label>
                                <div class="settings-btn upload-files-avator">
                                    <input type="file" accept="image/*" name="image" id="file"
                                        onchange="if (!window.__cfRLUnblockHandlers) return false; loadFile(event)"
                                        class="hide-input" data-cf-modified-0bb4667ad65003b9a531d68f->
                                    <label for="file" class="upload">Choose File</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-xl-6">
                            <div class="input-block select-gender">
                                <label class="gen-label">Status <span
                                        class="login-danger">*</span></label>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" name="gender"
                                            class="form-check-input mt-0">Active
                                    </label>
                                </div>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" name="gender"
                                            class="form-check-input mt-0">In Active
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="doctor-submit text-end">
                                <button type="submit"
                                    class="btn btn-primary submit-form me-2">Submit</button>
                                <button type="submit"
                                    class="btn btn-primary cancel-form">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection