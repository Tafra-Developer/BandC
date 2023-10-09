    <!-- =========== start about ============== -->
    <section id="about" class="py-5">
        <div class="container">
            <!-- ======== heading ====== -->
            <div class="about-heading heading">
                <h2>
                    {{ __('إعرف عنا') }}
                </h2>
                <p class="fw-bold">
                {{ __('من نحن ؟') }}
                </p>
            </div>
            <div class="row pt-5 justify-content-between align-items-center">
                <div class="col-lg-8 mb-3">
                    <div class="about-cap">
                        <h3 class="fw-bold">{{ __('بيوتي أند كير') }} ...</h3>
                        <p>
                        {{ __('تضم عيادات بيوتي اند كير نخبة من أفضل الأطباء بالمملكة العربية السعودية في جميع اقسامها المختلفة وتعتمد على استخدام التقنيات الطبية المتقدمة على ايد خبراء الاطباء المتخصصين بالتخصصات الدقيقة فى تخصص الجراحات التجميلة والحروق وتخصص الجلدية والليزر وتخصص الأذن و الأنف و الحنجرة وتخصص العيون وتخصص امراض النساء والولادة لتقديم خدمات متطورة ذات جودة عالية تتبع منظمة الصحة العالمية ووزارة الصحة والمعايير الدولية. حيث يتم تقديم كافة خدمات الجراحات التجميلية من شفط الدهون وشد البطن وتكبير وتصغير الثدي والتثدي عند الرجال ونحت الجسم وإنقاص الوزن . ويتم تقديم خدمات وعلاجات الامراض الجلدية جميعها وخدمات الحقن التجميلي وخدمات إزالة الشعر بالليزر وعلاجات تساقط الشعر وشد البشرة وعلاج والسيلولايت ويتم علاج أمراض الأذن و الأنف و الحنجرة ونزيف الاذن وانسداد الانف والصداع ويتم علاج امراض العيون التهابات العين والمناعة والامراض الشبكية والسكر وعلاج امراض النساء والولادة الأورام النسائية والمسالك البولية وتاخر الحمل وسلس البول النسائي والولادات الطبيعية والقيصرية. وهدفنا دائما النمو وتوسيع دائرة خدماتنا لتشمل جميع احتياجاتكم بما يرتقي مع طموحنا وشغفنا بتقديم رعاية طبية كاملة و استثنائية.') }}
                        </p>
                    </div>
                    <div class="about-icons">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex justify-content-start align-items-center">
                                    <span class="ms-2 d-flex justify-content-center align-items-center">
                                        <i class="fa-sharp fa-solid fa-people-group fs-5"></i>
                                    </span>
                                    <h6 class="fw-bold fs-5 {{ Session::get('locale') == 'en' ? 'm-2':''}}">
                                        {{ __('نعمل بجد لإسعادكم') }}
                                    </h6>
                                </div>
                                <div class="d-flex justify-content-start align-items-center mt-3">
                                    <span class="ms-2 d-flex justify-content-center align-items-center">
                                        <i class="fa-solid fa-headset fs-5"></i>
                                    </span>
                                    <h6 class="fw-bold fs-5 {{ Session::get('locale') == 'en' ? 'm-2':''}}">
                                        {{ __('خدمة عملاء علي أعلي مستوي') }}
                                    </h6>
                                </div>
                                <div class="d-flex justify-content-start align-items-center mt-3">
                                    <span class="ms-2 d-flex justify-content-center align-items-center">
                                        <i class="fa-solid fa-user-nurse fs-5"></i>
                                    </span>
                                    <h6 class="fw-bold fs-5 {{ Session::get('locale') == 'en' ? 'm-2':''}}">
                                        {{ __('طاقم عمل خبير') }}
                                    </h6>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="icon-left d-flex justify-content-start align-items-center">
                                    <span class="ms-2 d-flex justify-content-center align-items-center">
                                        <i class="fa-solid fa-cloud-bolt fs-5"></i>
                                    </span>
                                    <h6 class="fw-bold fs-5 {{ Session::get('locale') == 'en' ? 'm-2':''}}">
                                        {{ __('أحدث الأجهزة العالمية') }}
                                    </h6>
                                </div>
                                <div class="d-flex justify-content-start align-items-center mt-3">
                                    <span class="ms-2 d-flex justify-content-center align-items-center">
                                        <i class="fa-solid fa-user-doctor fs-5"></i>
                                    </span>
                                    <h6 class="fw-bold fs-5 {{ Session::get('locale') == 'en' ? 'm-2':''}}">
                                        {{ __('أطباء محترفين') }}
                                    </h6>
                                </div>
                                <div class="d-flex justify-content-start align-items-center mt-3">
                                    <span class="ms-2 d-flex justify-content-center align-items-center">
                                        <i class="fa-solid fa-house-medical fs-5"></i>
                                    </span>
                                    <h6 class="fw-bold fs-5 {{ Session::get('locale') == 'en' ? 'm-2':''}}">
                                        {{ __('تقنيات حديثة') }}
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="about-img">
                        <img src="{{ asset('front/img/about-img.png') }}" alt="skin cleaning case" class="w-100" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- =========== end about ============== -->
