@extends ('index')

@section ('content')
    <div class="wrapper">
        <main class="main-content">
            <div class="my-profile">
                <h2 class="heading">Мой профиль</h2>
                <div class="profile">
                    <div class="avatar">Avatar</div>
                    <div class="information">
                        <div class="nickname">Nickname</div>
                        <div class="user-name">
                            <span class="name">Имя</span>
                            <span class="surname">Фамилия</span>
                        </div>
                        <a href='tel:+11111111' class="phone">+1 111 11-11-11</a>
                    </div>
                </div>
            </div>

            @if (isset($user))

                <div class='edit-profile'>
                    <h2 class="heading">Редактировать профиль</h2>
                    <form class='form' id='form' method='POST' enctype='multipart/form-data'
                          action="{{ route('user.store') }}">
                        {{ csrf_field() }}

                        <ul class="form__list">
                            <li class="form__item">
                                <label class='form__label' for="nickname">Никнейм:</label>
                                {{ $user->nickname }}
                            </li>
                            <li class="form__item">
                                <label class='form__label' for="name">Имя:</label>
                                {{ $user->name }}
                            </li>
                            <li class="form__item">
                                <label class='form__label' for="surname">Фамилия:</label>
                                {{ $user->surname }}
                            </li>
                            <li class="form__item">
                                <label class='form__inline-label' for="avatar">Аватар:</label>
                                <img src="{{ asset('images/'.$user->avatar )}}">
                            </li>
                            <li class="form__item">
                                <label class='form__label' for="phone">Телефон:</label>
                                {{ $user->phone }}
                            </li>
                            <li class="form__item">
                                <div class="form__title">Пол: {{ $user->sex }}</div>
                            </li>
                            <li class="form__item">
                                <div class="form__title">Я согласен получать
                                    email-рассылку: {{ $user->newsletter_agree === '1' ? "согласен" : "не согласен"}}</div>
                            </li>
                        </ul>
                    </form>
                </div>

            @else

                <div class='edit-profile'>
                    <h2 class="heading">Редактировать профиль</h2>
                    <form class='form' id='form' method='POST' enctype='multipart/form-data'
                          action="{{ route('user.store') }}">
                        {{ csrf_field() }}

                        <ul class="form__list">
                            <li class="form__item">
                                <label class='form__label' for="nickname">Никнейм:</label>
                                <input class='form__input' id='nickname' type="text" name='nickname'>
                            </li>
                            <li class="form__item">
                                <label class='form__label' for="name">Имя:</label>
                                <input class='form__input' id='name' type="text" name='name'>
                            </li>
                            <li class="form__item">
                                <label class='form__label' for="surname">Фамилия:</label>
                                <input class='form__input' id='surname' type="text" name='surname'>
                            </li>
                            <li class="form__item">
                                <label class='form__inline-label' for="image">Аватар:</label>
                                <input class='form__inline-input' id='image' type="file" value='image/jpeg,image/png'
                                       name='image'>
                            </li>
                            <li class="form__item">
                                <label class='form__label' for="phone">Телефон(10 цифр):</label>
                                <input class='form__input' id='phone' type="text" name='phone'>
                            </li>
                            <li class="form__item">
                                <div class="form__title">Пол:</div>
                                <label class='form__inline-label' for="male">Мужской</label>
                                <input class='form__inline-input' name='male' id='male' type="radio">
                                <label class='form__inline-label' for="female">Женский</label>
                                <input class='form__inline-input' name='female' id='female' type="radio">
                            </li>
                            <li class="form__item">
                                <label class='form__inline-label' for="newsletter_agree">Я согласен получать
                                    email-рассылку</label>
                                <input class='form__inline-input' id='newsletter_agree' type="hidden"
                                       name='newsletter_agree' value="0" checked>
                                <input class='form__inline-input' id='newsletter_agree' type="checkbox"
                                       name='newsletter_agree' value="1">
                            </li>
                            <li class="form__item">
                                <button class='form__button' type="submit">Отправить</button>
                            </li>
                        </ul>
                    </form>
                </div>

            @endif
        </main>
    </div>
@endsection


