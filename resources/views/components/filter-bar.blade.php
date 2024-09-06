<div class="row col-md-12 mt-3">
    <div class="ml-0">
        <div class="">
            <div class="">
                <select class="form-select w-25" aria-label="Default select example" onchange="patientsStatus()">
                    <option value="0" selected>Status paciente</option>
                    <option value="1">Serviços gerais</option>
                    <option value="2">Internamento</option>
                    <option value="3">Consulta</option>
                </select>
            </div>
        </div>
    </div>
</div>

<script>

  
function patientsStatus(){

  if($('select').val() == 0){
    getAllPatient();
  }else{
    filterPatients();
  }

}

function filterPatients(){
  $('select').on('change', function(e) {
    e.preventDefault();
  
    var selectValue = $(this).val();
    var token = "{{ auth()->user()->createToken('TokenName')->plainTextToken }}";
  
    $.ajax({
      url: "{{ route('patient.all') }}",
      type: 'GET',
      data: {
        statusCode: selectValue,
      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        'Authorization': 'Bearer ' + token
      }
    })
    .done(function(response) {
      displayPatients(response);
    })
    .fail(function(response) {
      alert('Erro ao criar paciente.');
    });
  });
}

</script>

