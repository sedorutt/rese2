@extends('layouts.app')
@section('content')

<div class="header flex justify-between">
  <h2><a href="{{ route('menu') }}">Rese</a></h2>
  <div class="search">
    <form class="form-inline form" *action="{{secure_url('/')}}" >
      @csrf
      <select name="searchArea" class="form-control select" >
        <option value="">All area</option>
        @foreach ($shops->unique('area') as $shop)
        <option value="{{ $shop->area->id}}">{{ $shop->area->area }}</option>
        @endforeach
      </select>
      <select name="searchGenre" class="form-control select" >
        <option value="">All genre</option>
        @foreach ($shops->unique('genre')  as $shop)
        <option value="{{ $shop->genre->id }}">{{ $shop->genre->genre }}</option>
        @endforeach
      </select>
      <input type="text" name="searchKeyword" value="{{ request('searchKeyword') }}" class="form-control use-icon" placeholder="&#xF002; Search...">
      <input type="submit" value="検索" class="btn btn-info">
    </form>
  </div>
</div>
<div class="page-frame">
  <div class="flex wrap">
    @foreach ($shops as $shop)
    <div class="right-card">
      <div class="card-image">
        <img src="{{$shop->image}}" alt="shop" class="shop-image">
      </div>
      <div class="card-text">
        <p class="name">{{ $shop->name }}</p>
        <p class="tags inline">#{{$shop->area->area}}</p>
        <p class="tags inline">#{{$shop->genre->genre}}</p>
        <div class="card-bottom flex column">
          <form action="{{route('detail',$shop->id)}}" name="detailForm">
            @csrf 
            <button type="submit" class="btn btn-primary">詳しくみる</button>
          </form>
          @if ($shop->favorite == null || $shop->favorite->user_id != auth()->id())
          <form action="{{route('good',$shop->id)}}" method="POST" class="mb-4" >
          @csrf
            <button type="submit" class="goodBtn">
              <i class="fas fa-heart fa-lg" id="heart"></i>
            </button>
          </form>
          @else
          <form action="{{route('normal',$shop->id)}}" method="POST" class="mb-4" >
          @csrf
          @method('DELETE')
              <button type="submit" class="goodBtn">
                <i class="fas fa-heart fa-lg" id="heart red"></i>
              </button>
          </form>
          @endif
        </div>
      </div>
    </div>
    @endforeach
  </div>    
</div>
@if (auth()->id()==1)
<div class="add-space">
  <h3>追加フォーム</h3>
  <form action="{{route('registerShop')}}" method="POST">
    @csrf
    {{ csrf_field() }}
    <div>
      <label for="name" class="add-label">shop name</label>
      <input type="text" id="name" name="name" class="add">
      <label for="image" class="add-label">shop image</label>
      <input type="text" id="image" name="image" class="add">
      <label for="content" class="add-label">shop content</label>
      <textarea name="content" id="content" cols="30" rows="10" class="add-content"></textarea>
      <label for="genre_id" class="add-label">genre-id</label>
      <input type="text" id="genre_id" name="genre_id" list="genreList"　required>
          <datalist id="genreList">
            @foreach ($genres->unique('id') as $genre)
              <option value="{{$genre->id}}">
                {{$genre->genre}}
              </option>              
            @endforeach
          </datalist>
      <label for="area_id" class="add-label">area_id</label>
      <input type="text" id="area_id" name="area_id" list="areaList"　required>
          <datalist id="areaList">
            @foreach ($areas->unique('area') as $area)
              <option value="{{$area->id}}">
                {{$area->area}}
              </option>              
            @endforeach
          </datalist>

      <button type="submit" name="shop">送信</button>
    </div>
    <div>
      <label for="registerGenre" class="add-label">Genre</label>
      <input type="text" id="registerGenre" name="registerGenre" class="add">
      <button type="submit" name="genre">Genre登録</button>
    </div>
    <div>
      <label for="registerArea" class="add-label">Area</label>
      <input type="text" id="registerArea" name="registerArea" class="add">
      <button type="submit" name="area">Area登録</button>
    </div>
</div>
@endif

@endsection

<style scoped>
  .inline{
    display: inline;
  }
  .goodBtn{
    background-color: rgba(255, 255, 255, 1);
    border: none;
  }
  #heart{
    color: gray;
  }
  #red{
    color: red;
  }
  .header h2 a{
    text-decoration: none;  
  }
  .justify-between {
    display: flex;
    justify-content: space-between;
  }
  .search {
    margin: 10px;
  }
  .form{
    border: none;
  }
  .use-icon {
    display: inline-block;
    font-family: FontAwesome;
    font-style: normal;
    font-weight: normal;
    line-height: 1;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
  }
  .page-frame{
      width: 100%;
      padding-left: 50px;
      position: relative;
  }
  .right-card {
      width: 17%;
      border-radius: 5px;
      box-shadow: 2px 2px 4px;
      overflow: hidden;
      margin-right: 25px;
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
      padding: 0.8rem;
  }
  .wrap {
      flex-wrap: wrap;
      display: flex;
      justify-content: center;
  }
  .tags {
      color: #000;
      font-size: 13px;
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
  .add-space{
    padding: 2rem;

  }
  .add-label{
    width: 10rem;
    display: block;
  }
  .add{
    width: 90%;
  }

  @media screen and (max-width : 1024px){
    .column{
      display: flex;
      flex-direction: column;
    }
    .tags{
      height: 25px;
      display: block;
    }
    .name{
      height: 50px;
    }
    .add-space{
      display: none;
    }
  }
</style>