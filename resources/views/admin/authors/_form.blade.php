<div class="flex flex-col sm:flex-row gap-4">
    <section class="sm:mb-4 w-full">
        <label class="block mb-2 text-sm font-bold text-gray-700" for="name">
            Name
        </label>
        <input type="text" name="name" id="name" value="{{old('name') ?? $author->name ?? null }}" placeholder="John Doe"
            class="w-full py-2 px-4 border text-sm  font-medium rounded-md focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-700">
        @error('name')
        <p class="text-xs italic text-red-500" role="alert">{{ $message }}</p>
        @enderror
    </section>
    <section class="sm:mb-4 w-full">
        <label class="block mb-2 text-sm font-bold text-gray-700" for="email">
            Email Address
        </label>
        <input type="email" name="email" id="email" value="{{old('email') ?? $author->email ?? null}}"
            placeholder="john@example.com"
            class="w-full py-2 px-4 border text-sm  font-medium rounded-md focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-700">
        @error('email')
        <p class="text-xs italic text-red-500" role="alert">{{ $message }}</p>
        @enderror
    </section>
</div>
<section class="sm:mb-4 w-full">
    <label class="block mb-2 text-sm font-bold text-gray-700" for="introduction">
        Introduction
    </label>
    <textarea name="introduction" id="introduction" cols="30" rows="10"
        value="{{old('introduction') ?? $author->introduction ?? null}}" placeholder="Introduction ..."
        class="w-full py-2 px-4 border text-sm  font-medium rounded-md focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-700"></textarea>
    @error('introduction')
    <p class="text-xs italic text-red-500" role="alert">{{ $message }}</p>
    @enderror
</section>