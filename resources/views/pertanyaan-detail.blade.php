@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card mb-4" >
        <div class="card-body">

                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Pertanyaan</th>
                        <th scope="col">Total Respon</th>
                        <th scope="col">Total Nilai</th>
                        <th scope="col">Persen</th>
                      </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < count($pertanyaan); $i++)
                            <tr>
                            <td>{{$pertanyaan[$i]['pertanyaan']}}</td>
                            <td>{{$pertanyaan[$i]['total_respon']}}</td>
                            <td>{{$pertanyaan[$i]['total_nilai']}}</td>
                            <td>{{$pertanyaan[$i]['total_persen']}}%</td>
                          </tr>
                        @endfor
                      {{-- @foreach ($pertanyaan as $item)
                      <tr>
                        <td>{{$item->pertanyaan}}</td>
                        <td>{{$item->total_respon}}</td>
                        <td>{{$item->total_nilai}}</td>
                        <td>{{$item->total_persen}}</td>
                      </tr>
                      @endforeach --}}
                    </tbody>
                  </table>
        </div>
    </div>
    <div class="row">
        @for ($i = 0; $i < count($pertanyaan); $i++)
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <span>{{$pertanyaan[$i]['id']}}</span>
                    </div>
                    <div class="card-body">
                        <canvas id="{{$pertanyaan[$i]['id']}}" width="400" height="400"></canvas>
                    </div>
                </div>
            </div>
        @endfor

    </div>

</div>

@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.js" integrity="sha256-8zyeSXm+yTvzUN1VgAOinFgaVFEFTyYzWShOy9w7WoQ=" crossorigin="anonymous"></script>

<script>
    let url = '{{route('get.survey')}}'
    console.log(url)
    $.ajax({
        url: url,
        method:'GET',
        success: function(ress){
            ress.forEach(element => {
                console.log(element.id)
                var ctx = document.getElementById(element.id).getContext('2d');
                var data = element.value
                var labels = element.label
                var data = {
                    datasets: [{
                        data:data,
                        backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                        ]
                    }],

                    // These labels appear in the legend and in the tooltips when hovering different arcs
                    labels:labels
                };

                var myPieChart = new Chart(ctx, {
                    type: 'pie',
                    data: data,

                });
            });
        }
    })

</script>
    {{-- <script>
var ctx = document.getElementById('myChart').getContext('2d');
let data = {
    datasets: [{
        data: [10, 20, 30],
        backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
        ]
    }],

    // These labels appear in the legend and in the tooltips when hovering different arcs
    labels: [
        'Red',
        'Yellow',
        'Blue'
    ]
};

var myPieChart = new Chart(ctx, {
    type: 'pie',
    data: data,

});
// var myChart = new Chart(ctx, {
//     type: 'bar',
//     data: {
//         labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
//         datasets: [{
//             label: '# of Votes',
//             data: [12, 19, 3, 5, 2, 3],
//             backgroundColor: [
//                 'rgba(255, 99, 132, 0.2)',
//                 'rgba(54, 162, 235, 0.2)',
//                 'rgba(255, 206, 86, 0.2)',
//                 'rgba(75, 192, 192, 0.2)',
//                 'rgba(153, 102, 255, 0.2)',
//                 'rgba(255, 159, 64, 0.2)'
//             ],
//             borderColor: [
//                 'rgba(255, 99, 132, 1)',
//                 'rgba(54, 162, 235, 1)',
//                 'rgba(255, 206, 86, 1)',
//                 'rgba(75, 192, 192, 1)',
//                 'rgba(153, 102, 255, 1)',
//                 'rgba(255, 159, 64, 1)'
//             ],
//             borderWidth: 1
//         }]
//     },
//     options: {
//         scales: {
//             yAxes: [{
//                 ticks: {
//                     beginAtZero: true
//                 }
//             }]
//         }
//     }
// });
</script> --}}

@endsection
