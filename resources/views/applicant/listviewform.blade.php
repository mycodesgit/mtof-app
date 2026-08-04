<div class="card-body">
    <ul class="nav nav-pills mb-3 bg-light p-2 rounded-2 d-inline-flex col-md-12" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-one-tab" data-bs-toggle="pill"
                data-bs-target="#pills-one" type="button" role="tab"
                aria-controls="pills-one" aria-selected="true">
                Form 1
            </button>
        </li>
        &nbsp;
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-two-tab" data-bs-toggle="pill"
                data-bs-target="#pills-two" type="button" role="tab"
                aria-controls="pills-two" aria-selected="false" tabindex="-1">
                Form 2
            </button>
        </li>
        &nbsp;
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-three-tab" data-bs-toggle="pill"
                data-bs-target="#pills-three" type="button" role="tab"
                aria-controls="pills-three" aria-selected="false" tabindex="-1">
                Form 3
            </button>
        </li>
        &nbsp;
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-four-tab" data-bs-toggle="pill"
                data-bs-target="#pills-four" type="button" role="tab"
                aria-controls="pills-four" aria-selected="false" tabindex="-1">
                Affidavit of Undertaking 1
            </button>
        </li>
        &nbsp;
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-five-tab" data-bs-toggle="pill"
                data-bs-target="#pills-five" type="button" role="tab"
                aria-controls="pills-five" aria-selected="false" tabindex="-1">
                Affidavit of Undertaking 2
            </button>
        </li>
    </ul>
    <div class="tab-content mt-3" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-one" role="tabpanel" aria-labelledby="pills-one-tab" tabindex="0">
            <div class="table-responsive" style="height: 500px; overflow-y: auto;">
                @foreach($applicant as $data) @endforeach
                <iframe src="{{ route('applicant.viewPDFform1', ['id' => $applicant->id]) }}" width="100%" height="500"></iframe>
            </div>
        </div>
        <div class="tab-pane fade" id="pills-two" role="tabpanel" aria-labelledby="pills-two-tab" tabindex="0">
            <iframe src="{{ route('applicant.viewPDFform2', ['id' => $applicant->id]) }}" width="100%" height="500"></iframe>
        </div>
        <div class="tab-pane fade" id="pills-three" role="tabpanel" aria-labelledby="pills-three-tab" tabindex="0">
            <iframe src="{{ route('applicant.viewPDFform3', ['id' => $applicant->id]) }}" width="100%" height="500"></iframe>
        </div>
        <div class="tab-pane fade" id="pills-four" role="tabpanel" aria-labelledby="pills-four-tab" tabindex="0">
            <iframe src="{{ route('applicant.viewPDFaou1', ['id' => $applicant->id]) }}" width="100%" height="500"></iframe>
        </div>
        <div class="tab-pane fade" id="pills-five" role="tabpanel" aria-labelledby="pills-five-tab" tabindex="0">
            <iframe src="{{ route('applicant.viewPDFaou2', ['id' => $applicant->id]) }}" width="100%" height="500"></iframe>
        </div>
    </div>
</div>