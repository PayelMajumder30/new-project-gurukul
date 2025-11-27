@php $isEdit = isset($contact); @endphp

@csrf

<div class="row g-3">
    <div class="col-12 col-md-4">
        <label for="name" class="form-label">Name</label>
        <input id="name" name="name" type="text"
            class="form-control @error('name') is-invalid @enderror"
            value="{{ old('name', $isEdit ? $contact->name : '') }}" required>
        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>


    <div class="col-12 col-md-4">
        <label for="email" class="form-label">Email</label>
        <input id="email" name="email" type="email"
            class="form-control @error('email') is-invalid @enderror"
            value="{{ old('email', $isEdit ? $contact->email : '') }}" required>
        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>


    <div class="col-12 col-md-4">
        <label for="phone" class="form-label">Phone</label>
        <input id="phone" name="phone" type="text"
            class="form-control @error('phone') is-invalid @enderror"
            value="{{ old('phone', $isEdit ? $contact->phone : '') }}" required>
        @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<div class="col-12">
    <label for="address" class="form-label">Address</label>
    <textarea id="address" name="address" rows="3"
              class="form-control @error('address') is-invalid @enderror">{{ old('address', $isEdit ? $contact->address : '') }}</textarea>
    @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>
