<form action="{{ route('user.update.address', $address_id) }}" method="post"
    class="prfilInfoForm neditAddressPrt formhide{{ $address_id }}" id="prfilInfoForm{{ $address_id }}"
    onsubmit="formValidate('{!! $address_id !!}', this)">
    {{ csrf_field() }}
    <p class="mt0">EDIT ADDRESS</p>
    <div class="dFlex">
        <div class="twoClmFormField">
            <div class="formGroup">
                <input class="formControl" placeholder="Name" type="text" name="name" value="{{ $userAdd->name }}"
                    required />
            </div>
        </div>
        <div class="twoClmFormField">
            <div class="formGroup">
                <input class="formControl" placeholder="Mobile number" type="text" name="phone"
                    value="{{ $userAdd->phone }}" required />
            </div>
        </div>
    </div>

    <div class="dFlex">
        <div class="twoClmFormField">
            <div class="formGroup"><select class="formControl" name="state" required>
                    <option value="">--Select State--</option>
                    @foreach (allState() as $key => $state)
                        <option value="{{ $key }}"
                            {{ $key == $userAdd->state ? ' selected="selected"' : '' }}>{{ $state }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="twoClmFormField">
            <div class="formGroup">
                <input class="formControl" placeholder="City/District/Town" type="text" name="city"
                    value="{{ $userAdd->city }}" required />
            </div>
        </div>
    </div>
    <div class="dFlex">
        <div class="twoClmFormField">
            <div class="formGroup">
                <input class="formControl" placeholder="Pincode" type="text" name="pincode"
                    value="{{ $userAdd->pincode }}" required />
            </div>
        </div>

        <div class="twoClmFormField">
            {{-- <div class="formGroup">
                                            <input class="formControl" placeholder="Locality" type="text" />
                                        </div> --}}
            <div class="formGroup">
                <input class="formControl" placeholder="Landmark (Optional)" type="text" name="landmark"
                    value="{{ $userAdd->landmark }}" />
            </div>
        </div>
    </div>

    <div class="dFlex">
        <div class="formGroup">
            <textarea class="formControl" placeholder="Address (Area and Street)" rows="4" name="address" required>{{ $userAdd->address }}</textarea>
        </div>
    </div>

    <p class="mt10">Address Type</p>
    <div class="twoClmFormField">
        <div class="formGroup">
            <div class="dFlexLeft">
                <div class="mgproRedio">
                    <input class="formControl" type="radio" id="Home{{ $userAdd->id }}" name="type"
                        value="Home" {{ $userAdd->type == 'Home' ? 'checked' : '' }} />
                    <label for="Home{{ $userAdd->id }}">Home</label>
                </div>
                <div class="mgproRedio">
                    <input class="formControl" type="radio" id="Office{{ $userAdd->id }}" name="type"
                        value="Office" {{ $userAdd->type == 'Office' ? 'checked' : '' }} />
                    <label for="Office{{ $userAdd->id }}">Office</label>
                </div>
            </div>
        </div>
    </div>

    <div class="dFlex">
        <div class="twoClmFormField">
            <button class="pinkBtn" type="submit">Save</button>
        </div>

        <div class="twoClmFormField">
            <a href="javascript:void(0)" class="cancelBtn">cancel</a>
        </div>
    </div>
</form>

<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

<script>
    $(document).ready(function() {
        $('.cancelBtnAjax').click(function() {
            $('.formhide' + {!! $address_id !!}).hide();
        });
    });
</script>
<script>
    function formValidate(id) {
        $(`#prfilInfoForm${id}`).validate({
            rules: {
                name: {
                    required: true
                },
                phone: {
                    required: true,
                    number: true,
                    minlength: 10,
                    maxlength: 11
                },
                city: {
                    required: true
                },
                pincode: {
                    required: true
                },
                address: {
                    required: true
                },
            },
            messages: {
                name: "Please enter your name",
                phone: {
                    required: "Please enter your mobile number",
                    number: "Please enter a valid mobile number",
                    minlength: "Please enter a valid mobile number",
                    maxlength: "Please enter a valid mobile number",
                },
                state: "Please select your state",
                city: "Please enter your city",
                pincode: "Please enter your pincode",
                address: "Please enter your address",
            }
        });
        if ($(`#prfilInfoForm${id}`).valid()) {
            $(`#prfilInfoForm${id}`).submit();
        } else {
        event.preventDefault();
            return false;
        }
    }
    $(".prfilInfoForm").submit({});
    $(".prfilInfoForm").validate({
        rules: {
            name: {
                required: true
            },
            phone: {
                required: true,
                number: true,
                minlength: 10,
                maxlength: 11
            },
            city: {
                required: true
            },
            pincode: {
                required: true
            },
            address: {
                required: true
            },
        },
        messages: {
            name: "Please enter your name",
            phone: {
                required: "Please enter your mobile number",
                number: "Please enter a valid mobile number",
                minlength: "Please enter a valid mobile number",
                maxlength: "Please enter a valid mobile number",
            },
            state: "Please select your state",
            city: "Please enter your city",
            pincode: "Please enter your pincode",
            address: "Please enter your address",
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
</script>
