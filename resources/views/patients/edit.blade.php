@extends('layouts.app')

@section('content')

<section>
	<nav aria-label="Page breadcrumb">
		<ol class="breadcrumb form-steps col-md-10 mx-auto">
			<div class="line"></div>
			<li class="breadcrumb-item active" aria-current="page"><span>1</span>@lang('PatientInfo')</li>
			<li class="breadcrumb-item"><span>2</span>@lang('FirstInterview')</li>
			<li class="breadcrumb-item"><span>3</span>@lang('TechnicalInfo')</li>
			<li class="breadcrumb-item"><span>4</span>@lang('FullInterview')</li>
		</ol>
	</nav>
 
	<form action="{{ route('patients.update') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
		<!-- Hospital -->
		@csrf
		<input type="hidden" name="id" value="{{ $edit->id }}">
		<input type="hidden" name="code" value="{{ $edit->code }}">

		<fieldset>
			<legend>@lang('hospital')</legend>
			<input type="hidden" name="id" value="{{ $edit->id }}">
			<div class="row">
				<div class="col">
					<div class="form-floating">
						<select name="health_facility_id" class="form-control" id="floatingHospital" placeholder="@lang('hospital')" required>
							<option value="">{{ '--'. __('hospital') .'--' }}</option>
							@foreach($health_facility as $item)
								<option {{ $item->id==$edit->health_facility_id ? 'selected' : '' }} value="{{$item->id}}">{{ $item->value }}</option>
							@endforeach
						</select>
						<label for="floatingHospital">@lang('hospital')</label>
					</div>
				</div>
				<div class="col">
					<div class="input-group">
						<div class="form-floating">
							<input required name="form_date" type="text"  id="floatingDob" class="form-control" placeholder="date" value="{{ getDateFormat($edit->form_date) }}">
							<label for="floatingdate">@lang('date') <span class="text-danger">*</span> </label>
							@error('form_date') <span class="error text-danger">សូមបញ្ចូល  @lang('date')</span> @enderror
						</div>
						<div class="input-group-prepend">
							<div class="input-group-text">
								<svg id="__TEMP__SVG__" xmlns="http://www.w3.org/2000/svg" width="20" height="22" viewBox="0 0 22 22">
									<path id="Path_23" data-name="Path 23" d="M0,2.75A2.75,2.75,0,0,1,2.75,0h16.5A2.75,2.75,0,0,1,22,2.75Z" fill="#717171"/>
									<path id="Path_24" data-name="Path 24" d="M0,4.125H22V19.25A2.75,2.75,0,0,1,19.25,22H2.75A2.75,2.75,0,0,1,0,19.25Zm8.938,5.5A1.375,1.375,0,1,0,7.563,8.25,1.375,1.375,0,0,0,8.938,9.625Zm5.5-1.375a1.375,1.375,0,1,1-1.375-1.375A1.375,1.375,0,0,1,14.438,8.25Zm2.75,1.375A1.375,1.375,0,1,0,15.813,8.25,1.375,1.375,0,0,0,17.188,9.625Zm-11,2.75A1.375,1.375,0,1,1,4.813,11,1.375,1.375,0,0,1,6.188,12.375Zm2.75,1.375a1.375,1.375,0,1,0-1.375-1.375A1.375,1.375,0,0,0,8.938,13.75Zm5.5-1.375A1.375,1.375,0,1,1,13.063,11,1.375,1.375,0,0,1,14.438,12.375Zm2.75,1.375a1.375,1.375,0,1,0-1.375-1.375A1.375,1.375,0,0,0,17.188,13.75Zm-11,2.75a1.375,1.375,0,1,1-1.375-1.375A1.375,1.375,0,0,1,6.188,16.5Zm2.75,1.375A1.375,1.375,0,1,0,7.563,16.5,1.375,1.375,0,0,0,8.938,17.875Zm5.5-1.375a1.375,1.375,0,1,1-1.375-1.375A1.375,1.375,0,0,1,14.438,16.5Z" fill="#717171" fill-rule="evenodd"/>
								</svg>
							</div>
						</div>
					</div>
				</div>
			</div>
		</fieldset>

		<!-- form fill -->
		<fieldset>
			<legend>@lang('FormFiller')</legend>
			<div class="row">
				<div class="col">
					<div class="form-floating">
						<input value="{{ $edit->form_writer_name }}" name="form_writer_name" type="text" class="form-control" id="floatingHospital" placeholder="@lang('hospital')">
						<label for="floatingHospital">@lang('name')</label>
					</div>
				</div>
				<div class="col">
					<div class="form-floating">
						<input value="{{ $edit->form_writer_phone }}" name="form_writer_phone" type="tel" class="form-control" id="floatingPhone" placeholder="@lang('PhoneNum')">
						<label for="floatingSearch">@lang('PhoneNum')</label>
					</div>
				</div>
			</div>
		</fieldset>

		<!-- test form -->
		<fieldset>
			<legend>@lang('TestingPurpose')</legend>
			<div class="d-flex mb-4 flex-wrap">

				@foreach($reason_testing as $item)

					<div class="form-check form-check-inline mb-3">
						<input class="form-check-input" type="radio" name="test_reason" value="{{ $item->id }}" id="{{$item->key}}" {{ $item->id==$edit->test_reason ? 'checked' : '' }}>
						<label class="form-check-label" for="doubt">{{ $item->value}}</label>
					</div>

				@endforeach

			</div>

			<div class="form-check form-check-inline d-flex align-items-center mb-3">
				<label class="form-check-label mr-3" for="socialevent">@lang('RelatedwithCovid')</label>
				<input class="form-check-input" {{ $edit->direct_exposure==1 ? 'checked' : '' }} value="{{ $edit->direct_exposure }}" name="direct_exposure" type="checkbox" id="socialevent" placeholder="@lang('RelatedwithCovid')">
			</div>
			<div class="row" id="covidRelated">
				<div class="col-md-6">
					<div class="form-floating">
						<input value="{{ $edit->exposure_name }}" name="exposure_name" type="text" class="form-control" id="floatingrelated" placeholder="@lang('RelatedCovidName')" {{ $edit->direct_exposure==1 ? "" : 'disabled' }} >
						<label for="floatingrelated">@lang('RelatedCovidName')</label>
					</div>
				</div>
				<div class="col-md-6 align-self-center">

					@foreach($related_patient as $item)
						<div class="form-check form-check-inline ml-lg-3">
							<input class="form-check-input" name="exposure_type" type="radio" value="{{$item->id}}" id="{{$item->key}}"  {{ $item->id==$edit->exposure_type ? 'checked' : '' }}>

							<label class="form-check-label" for="intouch">{{ $item->value }}</label>
						</div>
					@endforeach

				</div>
			</div>
		</fieldset>

		<!-- Patient info -->
		<fieldset>
			<legend>@lang('PatientInfo')</legend>
			<div class="row justify-content-between mb-4">
				<div class="col-md-3">
					<div class="form-floating">
						<input required value="{{ $edit->name }}" name="name" type="text"  class="form-control" id="floatingHospital" placeholder="@lang('hospital')">
						<label for="floatingHospital">@lang('PatientName') <span class="text-danger">*</span></label>
						@error('name') <span class="error text-danger">សូមបញ្ចូល @lang('PatientName') </span> @enderror
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-floating">
						<input value="{{ $edit->code }}" name="code" type="text" class="form-control" id="floatingSearch" placeholder="@lang('PatientID')" disabled>
						<label for="floatingSearch">@lang('PatientID')</label>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-floating">
						<select name="gender" required class="form-control"  id="floatingHospital" placeholder="@lang('Gender')">
							<option value="">{{ '--'. __('Gender') .'--' }}</option>
							@foreach($gender as $item)
								<option {{ $edit->gender==$item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->value }}</option>
							@endforeach
						</select>
						<label for="floatingHospital">@lang('Gender') <span class="text-danger">*</span></label>
						@error('gender') <span class="error text-danger">សូមជ្រើសរើស @lang('Gender') </span> @enderror
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-floating">
						<input value="{{ $edit->patient_age }}" name="patient_age" type="text" class="form-control" id="floatingSearch" placeholder="@lang('Age')" >
						<label for="floatingSearch">@lang('Age')</label>
					</div>
				</div>
			</div>

			<div class="row justify-content-between mb-4">
				<div class="col-md-3">
					<div class="input-group">
						<div class="form-floating">
							<input value="{{ getDateFormat($edit->dob) }}" name="dob" type="text"  class="form-control" id="floatingDob" placeholder="dob">
							<label for="floatingdob">@lang('Dob')</label>
						</div>
						<div class="input-group-prepend">
							<div class="input-group-text">
								<svg id="__TEMP__SVG__" xmlns="http://www.w3.org/2000/svg" width="20" height="22" viewBox="0 0 22 22">
									<path id="Path_23" data-name="Path 23" d="M0,2.75A2.75,2.75,0,0,1,2.75,0h16.5A2.75,2.75,0,0,1,22,2.75Z" fill="#717171"/>
									<path id="Path_24" data-name="Path 24" d="M0,4.125H22V19.25A2.75,2.75,0,0,1,19.25,22H2.75A2.75,2.75,0,0,1,0,19.25Zm8.938,5.5A1.375,1.375,0,1,0,7.563,8.25,1.375,1.375,0,0,0,8.938,9.625Zm5.5-1.375a1.375,1.375,0,1,1-1.375-1.375A1.375,1.375,0,0,1,14.438,8.25Zm2.75,1.375A1.375,1.375,0,1,0,15.813,8.25,1.375,1.375,0,0,0,17.188,9.625Zm-11,2.75A1.375,1.375,0,1,1,4.813,11,1.375,1.375,0,0,1,6.188,12.375Zm2.75,1.375a1.375,1.375,0,1,0-1.375-1.375A1.375,1.375,0,0,0,8.938,13.75Zm5.5-1.375A1.375,1.375,0,1,1,13.063,11,1.375,1.375,0,0,1,14.438,12.375Zm2.75,1.375a1.375,1.375,0,1,0-1.375-1.375A1.375,1.375,0,0,0,17.188,13.75Zm-11,2.75a1.375,1.375,0,1,1-1.375-1.375A1.375,1.375,0,0,1,6.188,16.5Zm2.75,1.375A1.375,1.375,0,1,0,7.563,16.5,1.375,1.375,0,0,0,8.938,17.875Zm5.5-1.375a1.375,1.375,0,1,1-1.375-1.375A1.375,1.375,0,0,1,14.438,16.5Z" fill="#717171" fill-rule="evenodd"/>
								</svg>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-3">
					<div class="form-floating">
						<select name="nation_id" required class="form-control"  id="floatingHospital" placeholder="@lang('Nationality')">
							<option value="">{{ '--'. __('Nationality') .'--' }}</option>
							@foreach($nation as $item)
								<option {{  $edit->nation_id==$item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->value }}</option>
							@endforeach
						</select>
						<label for="floatingHospital">@lang('Nationality') <span class="text-danger">*</span></label>
						@error('nation_id') <span class="error text-danger">សូមបញ្ចូល @lang('Nationality') </span> @enderror
					</div>
				</div>

				<div class="col-md-3">
					<div class="input-group">
						<div class="form-floating">
							<input value="{{ getDateFormat($edit->positive_date) }}" name="positive_date" type="text"  class="form-control" id="positiveDate" placeholder="dob">
							<label for="floatingdob">@lang('Positive_date')</label>
						</div>
						<div class="input-group-prepend">
							<div class="input-group-text">
								<svg id="__TEMP__SVG__" xmlns="http://www.w3.org/2000/svg" width="20" height="22" viewBox="0 0 22 22">
									<path id="Path_23" data-name="Path 23" d="M0,2.75A2.75,2.75,0,0,1,2.75,0h16.5A2.75,2.75,0,0,1,22,2.75Z" fill="#717171"/>
									<path id="Path_24" data-name="Path 24" d="M0,4.125H22V19.25A2.75,2.75,0,0,1,19.25,22H2.75A2.75,2.75,0,0,1,0,19.25Zm8.938,5.5A1.375,1.375,0,1,0,7.563,8.25,1.375,1.375,0,0,0,8.938,9.625Zm5.5-1.375a1.375,1.375,0,1,1-1.375-1.375A1.375,1.375,0,0,1,14.438,8.25Zm2.75,1.375A1.375,1.375,0,1,0,15.813,8.25,1.375,1.375,0,0,0,17.188,9.625Zm-11,2.75A1.375,1.375,0,1,1,4.813,11,1.375,1.375,0,0,1,6.188,12.375Zm2.75,1.375a1.375,1.375,0,1,0-1.375-1.375A1.375,1.375,0,0,0,8.938,13.75Zm5.5-1.375A1.375,1.375,0,1,1,13.063,11,1.375,1.375,0,0,1,14.438,12.375Zm2.75,1.375a1.375,1.375,0,1,0-1.375-1.375A1.375,1.375,0,0,0,17.188,13.75Zm-11,2.75a1.375,1.375,0,1,1-1.375-1.375A1.375,1.375,0,0,1,6.188,16.5Zm2.75,1.375A1.375,1.375,0,1,0,7.563,16.5,1.375,1.375,0,0,0,8.938,17.875Zm5.5-1.375a1.375,1.375,0,1,1-1.375-1.375A1.375,1.375,0,0,1,14.438,16.5Z" fill="#717171" fill-rule="evenodd"/>
								</svg>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-3">
					<div class="form-floating">
						<input required value="{{  $edit->phone }}" name="phone" type="text"  class="form-control" id="floatingSearch" placeholder="@lang('PhoneNum')">
						<label for="floatingSearch">@lang('PhoneNum') <span class="text-danger">*</span></label>
						@error('phone') <span class="error text-danger">សូមបញ្ចូល @lang('PhoneNum') </span> @enderror
					</div>
				</div>

			</div>

			<div class="row mb-4">

				<div class="col-md-3">
					<div class="form-floating">
						<input value="{{ $edit->second_phone }}" name="second_phone" type="number"  class="form-control" id="floatingSearch" placeholder="@lang('PhoneNum')">
						<label for="floatingSearch">@lang('PhoneNum')</label>
					</div>
				</div>

				<div class="col-md-6">

					<div class="form-floating">
						<input value="{{  $edit->job }}" name="job" type="text" class="form-control" id="floatingSearch" placeholder="@lang('Job')">
						<label for="floatingSearch">@lang('Job')</label>
					</div>

				</div>

				<div class="d-flex justify-content-between flex-wrap mb-4">				
					<div class="form-check form-check-inline ml-3">
						<input name="death" class="form-check-input" type="checkbox" {{ $edit->death=='on' ? 'checked' : '' }} >
						<label class="form-check-label" for="nose">ស្លាប់</label>
					</div>
				</div>

			</div>

			<label class="mb-3">@lang('CurrentAdd')</label>

			<div class="input-group mb-4">
				<div class="form-floating">
					<input value="{{  $edit->address }}" name="address" type="text" class="form-control" id="floatingSearch" placeholder="@lang('PatientAdd')">
					<label for="floatingSearch">@lang('PatientAdd')</label>
				</div>
			</div>

			<div class="row mb-4">
				<div class="col-md-3">
					<div class="form-floating">
						<select name="province" class="form-control" id="floatingHospital" placeholder="@lang('CityProvince')">
							<option value="">{{ '--'. __('CityProvince') .'--' }}</option>
							@foreach($provinces as $item)
								<option {{ $item->code==$edit->province ?  'selected' : '' }} value="{{ $item->code }}">{{ $item->name_kh }}</option>
							@endforeach
						</select>
						<label for="floatingHospital">@lang('CityProvince')</label>
					</div>
				</div>

				<div class="col-md-3">
					<div class="form-floating">
						<select name="district" class="form-control" id="district_id" placeholder="@lang('Commune')">
							<option value="{{ $edit->district ?? 0 }}">{{ getLabelDistrict($edit->district) ?? '--'. __('Commune') .'--' }}</option>

						</select>
						<label for="floatingHospital">@lang('Commune')</label>
					</div>
				</div>

				<div class="col-md-3">
					<div class="form-floating">
						<select name="commune" class="form-control" id="commune_id" placeholder="@lang('District')">
							<option value="{{ $edit->commune ?? 0 }}">{{ getLabelCommune($edit->commune)  ?? '--'. __('District') .'--' }}</option>
						</select>
						<label for="floatingHospital">@lang('District')</label>
					</div>
				</div>

				<div class="col-md-3">
					<div class="form-floating">
						<select name="village" class="form-control" id="village_id" placeholder="@lang('Phumi')">
							<option value="{{ $edit->village ?? 0 }}">{{ getLabelVillage($edit->village)  ?? '--'. __('Phumi') .'--' }}</option>
						</select>
						<label for="floatingHospital">@lang('Phumi')</label>
					</div>
				</div>

			</div>

			<div class="row justify-content-between mb-4">
				
				<div class="col-md">
					<div class="form-floating">
						<input value="{{ $edit->address_description }}" name="address_description" type="text" class="form-control" id="floatingSearch" placeholder="@lang('Other')">
						<label for="floatingSearch">@lang('Other')</label>
					</div>
				</div>

			</div>

			<label class="mb-3 d-block">@lang('ClinicSymptoms')</label>

			<div class="d-flex justify-content-between flex-wrap mb-4">

				@foreach($clinical_symptom as $item)
					<div class="form-check form-check-inline mb-3 mb-md-0">
						<input {{ getSymptom($item->id,$edit->symptom) }} name="clinical_symtom[]" class="form-check-input" type="checkbox" id="fever" value="{{ $item->id }}">
						<label class="form-check-label" for="fever">{{ $item->value }}</label>
					</div>
				@endforeach

			</div>

			<div class="row mb-4">
				<div class="col-md-3">
					<div class="input-group">
						<div class="form-floating">
							<input value="{{ getDateFormat($edit->symptom_date) }}" name="symptom_date" type="text" class="form-control" id="symptomDate" placeholder="@lang('Analysist')">
							<label for="floatingSearch">@lang('SymptomDate')</label>
						</div>
						<div class="input-group-prepend">
							<div class="input-group-text">
								<svg id="__TEMP__SVG__" xmlns="http://www.w3.org/2000/svg" width="20" height="22" viewBox="0 0 22 22">
									<path id="Path_23" data-name="Path 23" d="M0,2.75A2.75,2.75,0,0,1,2.75,0h16.5A2.75,2.75,0,0,1,22,2.75Z" fill="#717171"/>
									<path id="Path_24" data-name="Path 24" d="M0,4.125H22V19.25A2.75,2.75,0,0,1,19.25,22H2.75A2.75,2.75,0,0,1,0,19.25Zm8.938,5.5A1.375,1.375,0,1,0,7.563,8.25,1.375,1.375,0,0,0,8.938,9.625Zm5.5-1.375a1.375,1.375,0,1,1-1.375-1.375A1.375,1.375,0,0,1,14.438,8.25Zm2.75,1.375A1.375,1.375,0,1,0,15.813,8.25,1.375,1.375,0,0,0,17.188,9.625Zm-11,2.75A1.375,1.375,0,1,1,4.813,11,1.375,1.375,0,0,1,6.188,12.375Zm2.75,1.375a1.375,1.375,0,1,0-1.375-1.375A1.375,1.375,0,0,0,8.938,13.75Zm5.5-1.375A1.375,1.375,0,1,1,13.063,11,1.375,1.375,0,0,1,14.438,12.375Zm2.75,1.375a1.375,1.375,0,1,0-1.375-1.375A1.375,1.375,0,0,0,17.188,13.75Zm-11,2.75a1.375,1.375,0,1,1-1.375-1.375A1.375,1.375,0,0,1,6.188,16.5Zm2.75,1.375A1.375,1.375,0,1,0,7.563,16.5,1.375,1.375,0,0,0,8.938,17.875Zm5.5-1.375a1.375,1.375,0,1,1-1.375-1.375A1.375,1.375,0,0,1,14.438,16.5Z" fill="#717171" fill-rule="evenodd"/>
								</svg>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md align-self-center">
					@lang('GotCovid')

					@foreach($covid_patient as $item)
						<div class="form-check form-check-inline ml-3">
							<input {{ $edit->was_positive==$item->id ? 'checked' : '' }} name="was_positive" class="form-check-input" type="radio" id="{{ $item->key }}" value="{{ $item->id }}">
							<label class="form-check-label" for="never">{{ $item->value }}</label>
						</div>
					@endforeach
				</div>
			</div>

			<label class="mb-3">@lang('TravelHistory')</label>

			<div class="row justify-content-between mb-4">

				<div class="col-md-3">
					<div class="form-floating">
						<input value="{{ $edit->travel_place }}" name="travel_place" type="text" class="form-control" id="floatingCountry" placeholder="@lang('CountryName')">
						<label for="floatingCountry">@lang('CountryName')</label>
					</div>
				</div>

				<div class="col-md-3">
					<div class="input-group">
						<div class="form-floating">
							<input value="{{ getDateFormat($edit->travel_date) }}" name="travel_date" type="text" id="arrivedDate" class="form-control" id="floatingArrived" placeholder="@lang('Arrived')">
							<label for="floatingArrived">@lang('Arrived')</label>
						</div>
						<div class="input-group-prepend">
							<div class="input-group-text">
								<svg id="__TEMP__SVG__" xmlns="http://www.w3.org/2000/svg" width="20" height="22" viewBox="0 0 22 22">
									<path id="Path_23" data-name="Path 23" d="M0,2.75A2.75,2.75,0,0,1,2.75,0h16.5A2.75,2.75,0,0,1,22,2.75Z" fill="#717171"/>
									<path id="Path_24" data-name="Path 24" d="M0,4.125H22V19.25A2.75,2.75,0,0,1,19.25,22H2.75A2.75,2.75,0,0,1,0,19.25Zm8.938,5.5A1.375,1.375,0,1,0,7.563,8.25,1.375,1.375,0,0,0,8.938,9.625Zm5.5-1.375a1.375,1.375,0,1,1-1.375-1.375A1.375,1.375,0,0,1,14.438,8.25Zm2.75,1.375A1.375,1.375,0,1,0,15.813,8.25,1.375,1.375,0,0,0,17.188,9.625Zm-11,2.75A1.375,1.375,0,1,1,4.813,11,1.375,1.375,0,0,1,6.188,12.375Zm2.75,1.375a1.375,1.375,0,1,0-1.375-1.375A1.375,1.375,0,0,0,8.938,13.75Zm5.5-1.375A1.375,1.375,0,1,1,13.063,11,1.375,1.375,0,0,1,14.438,12.375Zm2.75,1.375a1.375,1.375,0,1,0-1.375-1.375A1.375,1.375,0,0,0,17.188,13.75Zm-11,2.75a1.375,1.375,0,1,1-1.375-1.375A1.375,1.375,0,0,1,6.188,16.5Zm2.75,1.375A1.375,1.375,0,1,0,7.563,16.5,1.375,1.375,0,0,0,8.938,17.875Zm5.5-1.375a1.375,1.375,0,1,1-1.375-1.375A1.375,1.375,0,0,1,14.438,16.5Z" fill="#717171" fill-rule="evenodd"/>
								</svg>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-3">
					<div class="form-floating">
						<input value="{{ $edit->travel_no }}" name="travel_no" type="text" class="form-control" id="floatingFlightNumber" placeholder="@lang('FlightNumber')">
						<label for="floatingFlightNumber">@lang('FlightNumber')</label>
					</div>
				</div>

			</div>

			<div class="row justify-content-between mb-4">
				<div class="col-md-3">
					<div class="form-floating">
						<input value="{{ $edit->travel_id }}" name="travel_id" type="text" class="form-control" id="floatingIdPassport" placeholder="@lang('IdPassport')">
						<label for="floatingIdPassport">@lang('IdPassport')</label>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-floating">
						<input value="{{ $edit->travel_chair }}" name="travel_chair" type="text" class="form-control" id="floatingChairNum" placeholder="@lang('ChairNum')">
						<label for="floatingChairNum">@lang('ChairNum')</label>
					</div>
				</div>
				<div class="col-md-3">
				</div>
				<div class="col-12 mt-4">
					<div class="form-floating">
						<textarea name="travel_description" id="" cols="30" rows="10" class="form-control h-auto" id="description" placeholder="@lang('Description')">{{ $edit->travel_description }}</textarea>
						<label for="description">@lang('TravelDescription')</label>
					</div>
				</div>
			</div>

		</fieldset>

		<!-- Virus Type -->
		<fieldset>
			<legend>@lang('Virus Type')</legend>
			<div class="row">
				<div class="col-6">
					<div class="form-floating">
						<select name="virus_type" class="form-control" id="floatingHospital" placeholder="@lang('Virus Type')">
							<option value="0">{{ '--'. __('Virus Type') .'--' }}</option>
							@foreach($variant as $item)

								<option {{ $edit->virus_type==$item->id ? "selected" : ''}} value="{{$item->id}}">{{ $item->value }}</option>

							@endforeach

						</select>
						<label for="floatingHospital">@lang('Virus Type')</label>
					</div>
				</div>
			</div>
		</fieldset>


		<!-- Labo -->
		<fieldset>
			<legend>@lang('ForLabo')</legend>
			<div class="row justify-content-between mb-4">
				<div class="col-md-3">
					<div class="form-floating">
						<input required value="{{ $edit->laboratory_name}}" name="laboratory_name" type="text"  class="form-control" id="floatingTest" placeholder="@lang('TestLocation')">
						<label for="floatingTest">@lang('TestLocation') <span class="text-danger">*</span></label>
						@error('laboratory_name') <span class="error text-danger">សូមបញ្ចូល @lang('TestLocation')</span> @enderror
					</div>
				</div>
				<div class="col-md-3">
					<div class="input-group">
						<div class="form-floating">
							<input value="{{ getDateFormat($edit->laboratory_date) }}" name="laboratory_date" type="text" id="testDate" class="form-control" id="floatingTestDate" placeholder="@lang('TestDate')">
							<label for="floatingTestDate">@lang('TestDate') <span class="text-danger">*</span></label>
							@error('laboratory_date') <span class="error text-danger">សូមបញ្ចូល @lang('TestDate')</span> @enderror
						</div>
						<div class="input-group-prepend">
							<div class="input-group-text">
								<svg id="__TEMP__SVG__" xmlns="http://www.w3.org/2000/svg" width="20" height="22" viewBox="0 0 22 22">
									<path id="Path_23" data-name="Path 23" d="M0,2.75A2.75,2.75,0,0,1,2.75,0h16.5A2.75,2.75,0,0,1,22,2.75Z" fill="#717171"/>
									<path id="Path_24" data-name="Path 24" d="M0,4.125H22V19.25A2.75,2.75,0,0,1,19.25,22H2.75A2.75,2.75,0,0,1,0,19.25Zm8.938,5.5A1.375,1.375,0,1,0,7.563,8.25,1.375,1.375,0,0,0,8.938,9.625Zm5.5-1.375a1.375,1.375,0,1,1-1.375-1.375A1.375,1.375,0,0,1,14.438,8.25Zm2.75,1.375A1.375,1.375,0,1,0,15.813,8.25,1.375,1.375,0,0,0,17.188,9.625Zm-11,2.75A1.375,1.375,0,1,1,4.813,11,1.375,1.375,0,0,1,6.188,12.375Zm2.75,1.375a1.375,1.375,0,1,0-1.375-1.375A1.375,1.375,0,0,0,8.938,13.75Zm5.5-1.375A1.375,1.375,0,1,1,13.063,11,1.375,1.375,0,0,1,14.438,12.375Zm2.75,1.375a1.375,1.375,0,1,0-1.375-1.375A1.375,1.375,0,0,0,17.188,13.75Zm-11,2.75a1.375,1.375,0,1,1-1.375-1.375A1.375,1.375,0,0,1,6.188,16.5Zm2.75,1.375A1.375,1.375,0,1,0,7.563,16.5,1.375,1.375,0,0,0,8.938,17.875Zm5.5-1.375a1.375,1.375,0,1,1-1.375-1.375A1.375,1.375,0,0,1,14.438,16.5Z" fill="#717171" fill-rule="evenodd"/>
								</svg>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-3"> 
					<div class="form-floating">
						<select name="labform_province" class="form-control" id="floatingLabo" placeholder="@lang('Labo')" required>
							<option value="">{{ '--'. __('CityProvince') .'--' }}</option>
							@foreach($provinces as $item)
								<option {{ $item->code==$edit->labform_province ?  'selected' : '' }} value="{{ $item->code }}">{{ $item->name_kh }}</option>
							@endforeach
						</select>
						<label for="floatingLabo">@lang('Labo')</label>
					</div>
				</div>

				<div class="col-md-3">
					<div class="form-floating">
						<select name="laboratory_id" class="form-control" id="floatingLabo" placeholder="@lang('Labo')">
							<option value="0">{{ '--'. __('Labo') .'--' }}</option>
							@foreach($lab_center as $item)
								<option {{ $edit->laboratory_id==$item->id ? 'selected' : ''}}  value="{{ $item->id }}">{{ $item->value }}</option>
							@endforeach
						</select>
						<label for="floatingLabo">@lang('Labo')</label>
					</div>
				</div>

			</div>

			<div class="row justify-content-between mb-4">
				<div class="col-md align-self-center">

					@lang('TestType')

					@foreach($type_specimen as $item)
						<div class="form-check form-check-inline ml-3">
							<input {{ getObjectTypes($item->id,$edit->objectTypes) }} name="object_types_id[]" class="form-check-input" type="checkbox" id="nose" value="{{$item->id}}">
							<label class="form-check-label" for="nose">{{$item->value}}</label>
						</div>
					@endforeach

				</div>

				<div class="col-md-3">
					<div class="form-floating">
						<select name="number_sample_id" class="form-control" id="floatingAnalysist" placeholder="@lang('Analysist')">
							<option value="0">{{ '--'. __('Analysist') .'--' }}</option>
							@foreach($number_sample as $item)

								<option {{ $item->id==$edit->number_sample_id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->value }}</option>

							@endforeach

						</select>
						<label for="floatingAnalysist">@lang('Analysist')</label>
					</div>
				</div>

			</div>

			<label class="mb-3">@lang('Vaccination')</label>

			<div class="row justify-content-between mb-4">
				<div class="col-md-3 align-self-center">
					<div class="form-check form-check-inline">
						<input {{ $edit->first_vaccine==1 ? 'checked' : '' }} name="first_vaccine" class="form-check-input vaccine1" type="checkbox" id="vaccine1">
						<label class="form-check-label" for="vaccine1">@lang('Vaccine1')</label>
					</div>
				</div>
				<div class="col-md-3 form-disabled1">
					<div class="input-group">
						<div class="form-floating">
							<input value="{{ getDateFormat($edit->first_vaccine_date) }}" name="first_vaccine_date" type="text" id="vaccine1Date" class="form-control" id="floatingVaccineDate" placeholder="@lang('VaccineDate')" {{ $edit->first_vaccine==1 ? "" : "disabled" }} >
							<label for="floatingVaccineDatee">@lang('VaccineDate')</label>
						</div>
						<div class="input-group-prepend">
							<div class="input-group-text">
								<svg id="__TEMP__SVG__" xmlns="http://www.w3.org/2000/svg" width="20" height="22" viewBox="0 0 22 22">
									<path id="Path_23" data-name="Path 23" d="M0,2.75A2.75,2.75,0,0,1,2.75,0h16.5A2.75,2.75,0,0,1,22,2.75Z" fill="#717171"/>
									<path id="Path_24" data-name="Path 24" d="M0,4.125H22V19.25A2.75,2.75,0,0,1,19.25,22H2.75A2.75,2.75,0,0,1,0,19.25Zm8.938,5.5A1.375,1.375,0,1,0,7.563,8.25,1.375,1.375,0,0,0,8.938,9.625Zm5.5-1.375a1.375,1.375,0,1,1-1.375-1.375A1.375,1.375,0,0,1,14.438,8.25Zm2.75,1.375A1.375,1.375,0,1,0,15.813,8.25,1.375,1.375,0,0,0,17.188,9.625Zm-11,2.75A1.375,1.375,0,1,1,4.813,11,1.375,1.375,0,0,1,6.188,12.375Zm2.75,1.375a1.375,1.375,0,1,0-1.375-1.375A1.375,1.375,0,0,0,8.938,13.75Zm5.5-1.375A1.375,1.375,0,1,1,13.063,11,1.375,1.375,0,0,1,14.438,12.375Zm2.75,1.375a1.375,1.375,0,1,0-1.375-1.375A1.375,1.375,0,0,0,17.188,13.75Zm-11,2.75a1.375,1.375,0,1,1-1.375-1.375A1.375,1.375,0,0,1,6.188,16.5Zm2.75,1.375A1.375,1.375,0,1,0,7.563,16.5,1.375,1.375,0,0,0,8.938,17.875Zm5.5-1.375a1.375,1.375,0,1,1-1.375-1.375A1.375,1.375,0,0,1,14.438,16.5Z" fill="#717171" fill-rule="evenodd"/>
								</svg>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3 form-disabled1">
					<div class="form-floating">
						<select name="first_vaccine_type_id" class="form-control" id="floatingVaccineType1" placeholder="@lang('VaccineType')" {{ $edit->first_vaccine==1 ? "" : "disabled" }}>
							<option value="0">{{ '--'. __('VaccineType') .'--' }}</option>
							@foreach($type_vaccine as $item)

								<option {{ $edit->first_vaccine_type_id==$item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->value }}</option>

							@endforeach
						</select>
						<label for="floatingVaccineType">@lang('VaccineType')</label>
					</div>
				</div>
			</div>

			<div class="row justify-content-between mb-4">
				<div class="col-md-3 align-self-center">
					<div class="form-check form-check-inline">
						<input {{ $edit->second_vaccine==1 ? 'checked' : '' }} name="second_vaccine" class="form-check-input vaccine2" type="checkbox" id="vaccine2">
						<label class="form-check-label" for="vaccine2">@lang('Vaccine2')</label>
					</div>
				</div>
				<div class="col-md-3 form-disabled2">
					<div class="input-group">
						<div class="form-floating">
							<input value="{{ getDateFormat($edit->second_vaccine_date) }}" name="second_vaccine_date" type="text" id="vaccine2Date" class="form-control" id="floatingVaccineDate" placeholder="@lang('VaccineDate')" {{ $edit->second_vaccine==1 ? "" : "disabled" }}>
							<label for="floatingVaccineDatee">@lang('VaccineDate')</label>
						</div>
						<div class="input-group-prepend">
							<div class="input-group-text">
								<svg id="__TEMP__SVG__" xmlns="http://www.w3.org/2000/svg" width="20" height="22" viewBox="0 0 22 22">
									<path id="Path_23" data-name="Path 23" d="M0,2.75A2.75,2.75,0,0,1,2.75,0h16.5A2.75,2.75,0,0,1,22,2.75Z" fill="#717171"/>
									<path id="Path_24" data-name="Path 24" d="M0,4.125H22V19.25A2.75,2.75,0,0,1,19.25,22H2.75A2.75,2.75,0,0,1,0,19.25Zm8.938,5.5A1.375,1.375,0,1,0,7.563,8.25,1.375,1.375,0,0,0,8.938,9.625Zm5.5-1.375a1.375,1.375,0,1,1-1.375-1.375A1.375,1.375,0,0,1,14.438,8.25Zm2.75,1.375A1.375,1.375,0,1,0,15.813,8.25,1.375,1.375,0,0,0,17.188,9.625Zm-11,2.75A1.375,1.375,0,1,1,4.813,11,1.375,1.375,0,0,1,6.188,12.375Zm2.75,1.375a1.375,1.375,0,1,0-1.375-1.375A1.375,1.375,0,0,0,8.938,13.75Zm5.5-1.375A1.375,1.375,0,1,1,13.063,11,1.375,1.375,0,0,1,14.438,12.375Zm2.75,1.375a1.375,1.375,0,1,0-1.375-1.375A1.375,1.375,0,0,0,17.188,13.75Zm-11,2.75a1.375,1.375,0,1,1-1.375-1.375A1.375,1.375,0,0,1,6.188,16.5Zm2.75,1.375A1.375,1.375,0,1,0,7.563,16.5,1.375,1.375,0,0,0,8.938,17.875Zm5.5-1.375a1.375,1.375,0,1,1-1.375-1.375A1.375,1.375,0,0,1,14.438,16.5Z" fill="#717171" fill-rule="evenodd"/>
								</svg>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3 form-disabled2">
					<div class="form-floating">
						<select name="second_vaccine_type_id" class="form-control" id="floatingVaccineType2" placeholder="@lang('VaccineType')" {{ $edit->second_vaccine==1 ? "" : "disabled" }}>
							<option value="0">{{ '--'. __('VaccineType') .'--' }}</option>
							@foreach($type_vaccine as $item)

								<option {{  $edit->second_vaccine_type_id==$item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->value }}</option>

							@endforeach
						</select>
						<label for="floatingVaccineType">@lang('VaccineType')</label>
					</div>
				</div>
			</div>

			<div class="row justify-content-between mb-4">
				<div class="col-md-3 align-self-center">
					<div class="form-check form-check-inline">
						<input {{ $edit->third_vaccine==1 ? 'checked' : ''  }} name="third_vaccine" class="form-check-input vaccine3" type="checkbox" id="vaccine3">
						<label class="form-check-label" for="vaccine3">@lang('Vaccine3')</label>
					</div>
				</div>
				<div class="col-md-3 form-disabled3">
					<div class="input-group">
						<div class="form-floating">
							<input value="{{ getDateFormat($edit->third_vaccine_date) }}" name="third_vaccine_date" type="text" id="vaccine3Date" class="form-control" id="floatingVaccineDate" placeholder="@lang('VaccineDate')" {{ $edit->third_vaccine==1 ? "" : "disabled" }}>
							<label for="floatingVaccineDatee">@lang('VaccineDate')</label>
						</div>
						<div class="input-group-prepend">
							<div class="input-group-text">
								<svg id="__TEMP__SVG__" xmlns="http://www.w3.org/2000/svg" width="20" height="22" viewBox="0 0 22 22">
									<path id="Path_23" data-name="Path 23" d="M0,2.75A2.75,2.75,0,0,1,2.75,0h16.5A2.75,2.75,0,0,1,22,2.75Z" fill="#717171"/>
									<path id="Path_24" data-name="Path 24" d="M0,4.125H22V19.25A2.75,2.75,0,0,1,19.25,22H2.75A2.75,2.75,0,0,1,0,19.25Zm8.938,5.5A1.375,1.375,0,1,0,7.563,8.25,1.375,1.375,0,0,0,8.938,9.625Zm5.5-1.375a1.375,1.375,0,1,1-1.375-1.375A1.375,1.375,0,0,1,14.438,8.25Zm2.75,1.375A1.375,1.375,0,1,0,15.813,8.25,1.375,1.375,0,0,0,17.188,9.625Zm-11,2.75A1.375,1.375,0,1,1,4.813,11,1.375,1.375,0,0,1,6.188,12.375Zm2.75,1.375a1.375,1.375,0,1,0-1.375-1.375A1.375,1.375,0,0,0,8.938,13.75Zm5.5-1.375A1.375,1.375,0,1,1,13.063,11,1.375,1.375,0,0,1,14.438,12.375Zm2.75,1.375a1.375,1.375,0,1,0-1.375-1.375A1.375,1.375,0,0,0,17.188,13.75Zm-11,2.75a1.375,1.375,0,1,1-1.375-1.375A1.375,1.375,0,0,1,6.188,16.5Zm2.75,1.375A1.375,1.375,0,1,0,7.563,16.5,1.375,1.375,0,0,0,8.938,17.875Zm5.5-1.375a1.375,1.375,0,1,1-1.375-1.375A1.375,1.375,0,0,1,14.438,16.5Z" fill="#717171" fill-rule="evenodd"/>
								</svg>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3 form-disabled3">
					<div class="form-floating">
						<select name="third_vaccine_type_id" class="form-control" id="floatingVaccineType3" placeholder="@lang('VaccineType')" {{ $edit->third_vaccine==1 ? "" : "disabled" }}>
							<option value="0">{{ '--'. __('VaccineType') .'--' }}</option>
							@foreach($type_vaccine as $item)

								<option {{ $edit->third_vaccine_type_id==$item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->value }}</option>

							@endforeach
						</select>
						<label for="floatingVaccineType">@lang('VaccineType')</label>
					</div>
				</div>
			</div>

			<label class="mb-3">@lang('Collector')</label>

			<div class="row justify-content-between mb-3">
				<div class="col-md-3">
					<div class="form-floating">
						<input value="{{ $edit->laboratory_collector }}" name="laboratory_collector" type="text" class="form-control" id="floatingCollectorName" placeholder="@lang('CollctorName')">
						<label for="floatingCollectorName">@lang('CollctorName')</label>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-floating">
						<input value="{{ $edit->laboratory_collector_phone }}" name="laboratory_collector_phone" type="text" class="form-control" id="floatingCollectorPhone" placeholder="@lang('CollctorPhone')">
						<label for="floatingCollectorPhone">@lang('CollctorPhone')</label>
					</div>
				</div>
				<div class="col-md-3"></div>
			</div>

			<div class="row justify-content-between">
				<div class="col-md-6">
					<label class="mb-3">@lang('ChooseDoc')</label>
					@if($edit->laboratory_file)
						<a target="_blank" href="{{ getUrl($edit->laboratory_file) }}"><b>ឯកសារ មើល</b></a>
					@endif
					<div class="custom-file">
						<input type="hidden" value="{{ $edit->laboratory_file }}" name="laboratory_file_row">
						<input id="file-upload" class="custom-file-input" type="file" name="laboratory_file">
						<label for="file-upload" class="custom-file-label">@lang('ChooseFile')</label>
					</div>
				</div>
				@csrf
				<div class="col-md-3 align-self-end text-right">
					<button type="submit" class="btn btn-primary px-5">@lang('BtnSave')</button>
				</div>
			</div>
		</fieldset>

	</form>

</section>

@stop

@section('scripts')
	<script>

		$('#floatingDob, #checkinDate, #dob,#symptomDate, #arrivedDate, #testDate, #vaccine1Date, #vaccine2Date, #vaccine3Date, #positiveDate').datepicker({
			uiLibrary: 'bootstrap4',
			format: 'dd/mm/yyyy'
		});
		// Disabled and Endable checkbox

		$('.socialevent').change(function () {
			if ($(this).is(':checked')) {
				$("div#covidRelated .form-floating, div#covidRelated .form-check").children().prop('disabled', false);
			} else {
				$("div#covidRelated .form-floating,  div#covidRelated .form-check").children().prop('disabled', true);
			}
		});

		// Prob disabled and enable vaccine
		$('.vaccine1').change(function () {
			if ($(this).is(':checked')) {
				$("div.form-disabled1 .form-floating").children().prop('disabled', false);
			} else {
				$("div.form-disabled1 .form-floating").children().prop('disabled', true);
			}
		});
		$('.vaccine2').change(function () {
			if ($(this).is(':checked')) {
				$("div.form-disabled2 .form-floating").children().prop('disabled', false);
			} else {
				$("div.form-disabled2 .form-floating").children().prop('disabled', true);
			}
		});
		$('.vaccine3').change(function () {
			if ($(this).is(':checked')) {
				$("div.form-disabled3 .form-floating").children().prop('disabled', false);
			} else {
				$("div.form-disabled3 .form-floating").children().prop('disabled', true);
			}
		});

	</script>
	<script>
		$(".custom-file-input").on("change", function() {
			var fileName = $(this).val().split("\\").pop();
			$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
		});
	</script> 

	<script>
		/*province*/
		$(document).ready(function(){
			$('select[name="province"]').on('change', function(){
				var pro_id = $(this).val();
				$('#district_id').empty();
				$('#district_id').append('<option >'+ '--ស្រុក/ខណ្ឌ--'+'</option>');
				$('#commune_id').empty();
				$('#village_id').empty();
				if (pro_id){
					var url = '{{ route('location.district', 'song') }}';
					url = url.replace('song', pro_id);
					$.ajax({
						url: url,
						type: 'GET',
						dataType: 'json',success: function(data){

							$.each(data, function(k, v) {
								$('#district_id').append('<option value="'+ v.code +'" name="' + v.name_kh + '">'+ v.name_kh +'</option>');
							});
						}
					});
				}
			});
		});
		/*commune*/
		$(document).ready(function(){
			$('select[name="district"]').on('change', function(){
				var dis_id = $(this).val();
				$('#commune_id').empty();
				$('#commune_id').append('<option >'+ '--ឃុំ/សង្កាត់--'+'</option>');
				$('#village_id').empty();
				if (dis_id){
					var url = '{{ route('location.commune', 'song') }}';
					url = url.replace('song', dis_id);
					$.ajax({
						url: url,
						type: 'GET',
						dataType: 'json',success: function(data){
							$.each(data, function(k, v) {
								$('#commune_id').append('<option value="'+ v.code +'" name="' + v.name_kh + '">'+ v.name_kh +'</option>');
							});
						}
					});
				}
			});
		});
		/*village*/
		$(document).ready(function(){
			$('select[name="commune"]').on('change', function(){
				var com_id = $(this).val();
				console.log(com_id);
				$('#village_id').empty();
				$('#village_id').append('<option >'+ '--ភូមិ--'+'</option>');
				if (com_id){
					var url = '{{ route('location.village', 'song') }}';
					url = url.replace('song', com_id);
					$.ajax({
						url: url,
						type: 'GET',
						dataType: 'json',success: function(data){
							$.each(data, function(k, v) {
								$('#village_id').append('<option value="'+ v.code +'" name="' + v.name_kh + '">'+ v.name_kh +'</option>');
							});
						}
					});
				}
			});
		});
	</script>
@stop