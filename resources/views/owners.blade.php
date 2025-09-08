<x-layouts.app>
    <x-slot name="owners">
        <div>
            <input type="search" name="search" id="search" placeholder="Search best Billboards">
            <button>search</button>
            <div>
                @foreach ($owners as $owner)
                    <div>
                        <img src="{{$owner->img}}" alt="">
                        <h2>$owner->place</h2>
                        <h3>$owner->name</h3>
                        <h3>Available from $owner->date</h3>
                        <div>
                            <p>$owner->price</p>
                            <button>Paynow</button>
                        </div>

                    </div>

                    
                @endforeach
            </div>
        </div>
    </x-slot>
</x-layouts.app>