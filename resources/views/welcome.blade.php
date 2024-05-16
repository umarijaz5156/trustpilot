<x-web-layout>

    <!-- Banner with Image -->
    <div class="bg-cover bg-center h-64 md:h-96" style="background-image: url('review-banner.jpg');">
        <div class="bg-black bg-opacity-50 h-full flex items-center justify-center">
            <h1 class="text-4xl md:text-6xl text-white font-bold">Discover and Share Reviews</h1>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto p-8">
            @if(session()->has('success'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show" class="bg-green-500 text-white p-4 rounded">
                {{ session('success') }}
            </div>
        @elseif(session()->has('error'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show" class="bg-red-500 text-white p-4 rounded">
                {{ session('error') }}
            </div>
        @endif
        
    
        <!-- Featured Reviews Section -->
        <section class="mb-8">
            <h2 class="text-2xl md:text-4xl font-bold mb-4">Featured Reviews</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Featured Review 1 -->
                <div class="bg-white p-4 rounded-md shadow-md">
                    <h3 class="text-xl font-bold mb-2">Restaurant XYZ</h3>
                    <p>Excellent service and delicious food! Highly recommended.</p>
                    <!-- Add star ratings or other review details -->
                </div>
                <!-- Featured Review 2 -->
                <div class="bg-white p-4 rounded-md shadow-md">
                    <h3 class="text-xl font-bold mb-2">Product ABC</h3>
                    <p>Amazing features and great value for money.</p>
                    <!-- Add star ratings or other review details -->
                </div>
                <!-- Featured Review 3 -->
                <div class="bg-white p-4 rounded-md shadow-md">
                    <h3 class="text-xl font-bold mb-2">Movie XYZ</h3>
                    <p>A must-watch film with an engaging storyline.</p>
                    <!-- Add star ratings or other review details -->
                </div>
            </div>
        </section>

        <!-- Popular Categories Section -->
        <section class="mb-8">
            <h2 class="text-2xl md:text-4xl font-bold mb-4">Popular Categories</h2>
            <div class="flex space-x-4">
                <!-- Category 1 -->
                <a href="#" class="bg-blue-500 text-white px-4 py-2 rounded-full">Restaurants</a>
                <!-- Category 2 -->
                <a href="#" class="bg-blue-500 text-white px-4 py-2 rounded-full">Electronics</a>
                <!-- Category 3 -->
                <a href="#" class="bg-blue-500 text-white px-4 py-2 rounded-full">Movies</a>
                <!-- Add more categories as needed -->
            </div>
        </section>

        <!-- Call-to-Action Section -->
        <section>
            <h2 class="text-2xl md:text-4xl font-bold mb-4">Contribute Your Review</h2>
            <p class="text-lg text-gray-700">Share your experiences with the world. Write a review and help others make
                informed decisions.</p>
            <a href="#" class="bg-blue-500 text-white px-6 py-3 rounded-full mt-4 inline-block">Write a Review</a>
        </section>

    </div>

</x-web-layout>
