<!-- ================ start Apointment Form ========== -->
@inject('categories', 'App\Models\Category')

<section id="appointment" class="py-5 ">
    <div class="container ">
        <div class="appointment-box shadow px-3 py-5">
            <h3 class="text-center fs-1 fw-bold">{{ __('إحـجـز مـوعـدك الأن') }}</h3>
            <div class="appointment-form d-flex justify-content-center align-items-center">
                <form action="{{ route('client.contact') }}" method="post" class="row g-1">
                    @csrf
                    <div class="col-md-6">
                        <label for="inputName" class="form-label"></label>
                        <input required placeholder="{{ __('الإســم') }}" name="name" type="text" class="form-control"
                            id="inputName" />
                    </div>
                    <div class="col-md-6">
                        <label for="inputPhone" class="form-label"></label>
                        <input required placeholder="{{ __('الهـاتـف') }}" name="phone" type="tel" class="form-control"
                            id="inputPhone" />
                    </div>

                    <div class="col-md-6">
                        <label for="inputState" class="form-label"></label>
                        <select required id="inputState" name="category_id" class="form-select">
                            <option selected>{{ __('خدماتنا') }}</option>
                            @foreach ($categories->get() as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="inputName" class="form-label"></label>
                        <input required placeholder="{{ __('موعد') }}" name="date" type="datetime-local" class="form-control"
                            id="inputName" />
                    </div>
                    <div class="col-12">
                        <label for="exampleFormControlEmail" class="form-label"></label>
                        <input name="email" placeholder="{{ __('ايميل') }}" type="email" required class="form-control" id="exampleFormControlEmail" />

                        <div class="col-12 mb-2">
                            <label for="exampleFormControlTextarea1" class="form-label"></label>
                            <textarea name="notes" placeholder="{{ __('طلب إضافي') }}" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>

                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-main w-50">
                                {{ __('إحجز الأن') }}
                            </button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- ================ end Apointment Form ========== -->
