@extends('layouts.app')
@section('content')
<h1>La fecha de hoy es:</h1>
<p><?php echo $dia, "  ", $mes, "  ", $year?></p>
@stop