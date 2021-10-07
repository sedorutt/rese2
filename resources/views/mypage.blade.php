@extends('layouts.app')
@section('content')

<div class="header">
  <h2><a href="{{ route('menu') }}">Rese</a></h2>
</div>
<div class="page-frame">
  <div class="user-name">
    <p class="bold">{{$user->name}}<span>さん</span></p>
  </div>
  <div class="mypage-card">
    <div class="mypage-left">
      <p class="card-title bold">予約状況</p>
      @foreach ($books as $book)
      <div class="left-card">
        <form action="{{route('destroy',$book->id)}}" method="POST" name="deleteForm">
          {{ csrf_field() }}
          {{ method_field('DELETE') }}
          <button class="submit-btn" type="submit">
            <i class="far fa-times-circle fa-lg"></i>
          </button>
        </form>
        <div class="card-title">
          <i class="far fa-clock fa-lg"></i>
          <p>予約</p>
        </div>
        <div>
          <form method="POST" action="{{route('update',$book->id)}}" class="update-form">
            @csrf
            {{ csrf_field() }}
            {{ method_field('PUT') }}
              <label for="name">shop</label >
              <input type="text" id="name" value="{{$book->shop->name}}" readonly class="readonly">
              <label for="reserved_date">予約日</label >
              <input type="date" id="reserved_date" value="{{$book->reserved_date}}" name="reserved_date" readonly class="readonly">
              <label for="reserved_time">予約時間</label >
              <input type="text" id="reserved_time" value="{{$book->reserved_time}}" name="reserved_time" readonly class="readonly">
              <label for="number">予約人数</label >
              <input type="number" id="number" value="{{$book->number}}" name="number" placeholder="人数" min="1" required>
            <button type="submit" class="right">更新</button>
          </form>
          @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif
        </div>
      </div>
      @endforeach
    </div>
    
    <div class="mypage-right">
      <p class="card-title bold">お気に入り店舗</p>
      <div class="flex wrap">
        @foreach ($favorite as $item)
        <div class="right-card ">
          <div class="card-image">
            <img src="{{$item->shop->image}}" alt="shop" class="shop-image">
          </div>
          <div class="card-text">
            <p class="name">{{$item->shop->name}}</p>
            <p class="tags inline">#{{$item->shop->area->area}}</p>
            <p class="tags inline">#{{$item->shop->genre->genre}}</p>
            <div class="card-bottom">
              <form action="{{route('detail',$item->shop->id)}}" name="detailForm">
                @csrf 
                <button type="submit" class="btn btn-primary">詳しくみる</button>
              </form>
              <form action="{{route('normal',$item->shop->id)}}" method="POST" class="mb-4" >
                @csrf
                @method('DELETE')
                <button type="submit" class="goodBtn">
                  <i class="fas fa-heart fa-lg" id="heart red"></i>
                </button>
              </form>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</div>  

@endsection

<style scoped>
  .goodBtn{
    background-color: rgba(255, 255, 255, 1);
    border: none;
  }
  #red{
    color: red;
  }
  .inline{
    display: inline;
  }
  .submit-btn {
    background-color: rgb(12, 92, 241);
    border: none;
  }
  .page-frame{
    width: 100%;
    padding-left: 50px;
    position: relative;
  }
  .user-name {
    margin-left: 50%;
  }
  .user-name p {
    font-size: 22px;
  }
  .user-name span {
    padding-left: 2px;
    font-weight: normal;
  }
  .mypage-card {
    display: flex;
    justify-content: space-between;
  }
  .mypage-left {
    width: 50%;
  }
  .left-card {
    position: relative;
    width: 80%;
    background-color: rgb(12, 92, 241);
    color: #fff;
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 5px;
  }
  .fa-times-circle{
    color: #fff;
    position: absolute;
    right: 20px;
    top: 20px;
  }
  .card-title {
    display: flex;
    font-size: 18px;
  }
  .fa-clock {
    padding-top: 6px;
  }
  label{
    width: 40%;
  }
  input{
    width: 50%;
    height: 2.5rem;
    border-radius: 5px;
    font-size: 3rem;
  }
  .readonly{
    background-color: rgb(12, 92, 241);
    border: none;
    color: #fff;
    font-size: 18px;
  }
  .right{
    display: block;
    margin-left: auto;
  }
  .mypage-right {
    width: 48%;
    margin-right: auto;
  }
  .right-card {
    width: 43%;
    border-radius: 5px;
    box-shadow: 2px 2px 4px;
    overflow: hidden;
    margin-right: 30px;
    margin-bottom: 40px;
  }
  .shop-image{
    width: 100%;
  }
  .name{
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 5px;
  }
  .card-text{
    background-color: #fff;
    padding: 20px;
  }
  .wrap {
    display: flex;
    flex-wrap: wrap;
  }
  .tags {
    color: #000;
  }
  .fa-heart{
    color: red;
  }
  .card-bottom{
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 15px;    
  }

</style>
