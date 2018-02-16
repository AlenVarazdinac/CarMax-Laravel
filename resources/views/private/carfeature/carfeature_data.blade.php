<?php $number=1;?>

<tbody class="cars-data">
    @foreach($carFeatures as $carFeature)
    <tr>
        <td class="text-center">
            {{$number}}<?php $number++;?>
        </td>
        <td class="text-center">
            {{$carFeature->car_feature_name}}
        </td>
        @if(Auth::user()->user_rights==='Admin')
        <td class="text-center">
            <a href="/carfeature_edit/{{$carFeature->car_feature_id}}">Edit</a> | <a href="/carfeature_remove/{{$carFeature->car_feature_id}}">Remove</a>
        </td>
        @endif
    </tr>

    @endforeach

    @if(Auth::user()->user_rights==='Admin')
    <tr>
        <td class="text-center" colspan="3">
            <a href="/carfeature_add">Add new feature</a>
        </td>
    </tr>
    @endif

</tbody>
