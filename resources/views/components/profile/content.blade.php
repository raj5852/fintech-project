<div class="dashboard__profile-content home-profile">
    <div class="dashboard__profile-header">
        <div class="dashboard__profile-thumb">
            <img src="{{ asset($userDetails->image) }}" alt="">
        </div>
    </div>
    <div class="dashboard__profile-body">
        <h1 class="__details">Deatils</h1>
        <div class="dashboard__profile-item abx">
            <span class="__head">Name :</span>
            <h4 class="__res">{{ $userDetails->name }}</h4>
        </div>
        <div class="dashboard__profile-item abx">
            <span class="__head">Email :</span>
            <h4 class="__res" style="text-transform: lowercase">{{ $userDetails->email }}</h4>
        </div>
        <div class="dashboard__profile-item abx">
            <span class="__head">Membership :</span>
            <h4 class="__res">
                {{ $userDetails->memberships_exists == true ? $userDetails->memberships[0]->membership_name : 'General' }}
            </h4>
        </div>
        @if ($userDetails->memberships_exists == true)
            <div class="dashboard__profile-item abx">
                <span class="__head">Membership Date :</span>
                <h4 class="__res ">

                {{ YearMonthDate($userDetails->memberships[0]->pivot->created_at) }}</h4>
            </div>
            <div class="dashboard__profile-item abx">
                <span class="__head">Expire Date :</span>
                <h4 class="__res">
                    {{ $userDetails->memberships_exists == true && $userDetails->memberships[0]->pivot->is_life_time == 0 ? $userDetails->memberships[0]->pivot->expire_date : 'Lifetime' }}
                </h4>
            </div>

            <div class="dashboard__profile-item abx">
                <a href="{{ route('renew_membership') }}" class="common-btn">Renew Membership </a>
            </div>
        @else

        <div class="dashboard__profile-item abx">
            <a href="{{ route('membership') }}" class="common-btn">Add Membership </a>
        </div>

        @endif


    </div>
</div>
