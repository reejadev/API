<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twitter API</title>
    @vite('resources/css/app.css')
    <style>
        .grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center; Adjust spacing between cards
            gap: 10px; /* Reduce the gap between cards */
        }

        .rounded {
            width: calc(33.33% - 10px); /* Adjust card width to fit reduced gap */
            margin-bottom: 10px; /* Reduce margin between cards */
        }

      
    </style>
</head>
<body>
    <div class="border-b mb-5 justify-center text-sm">
        <div class="align-center">
            <a href="#" class="font-semibold inline-block">Cooking Blog</a>
        </div>
        <a href="#">See All</a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-5">
        <!-- CARD 1 -->
        <div class="rounded overflow-hidden shadow-lg flex flex-col">
            <div class="relative">
                <a href="#">
                    <img class="w-full" src="https://images.pexels.com/photos/61180/pexels-photo-61180.jpeg?auto=compress&amp;cs=tinysrgb&amp;dpr=1&amp;w=500" alt="Sunset in the mountains">
                    <div class="text-xs absolute top-0 right-0 bg-indigo-600 px-4 py-2 text-white mt-3 mr-3 hover:bg-white hover:text-indigo-600 transition duration-500 ease-in-out">Cooking</div>
                </a>
            </div>
            <div class="px-6 py-4 mb-auto">
                <div class="flex space-x-2 mb-2">
                    <a href="{{ route('twitter') }}" class="font-medium text-lg inline-block hover:text-indigo-600 transition duration-500 ease-in-out">ConnectTwitter</a>
                    &nbsp;
                    <a href="#" class="font-medium text-lg inline-block hover:text-indigo-600 transition duration-500 ease-in-out">{{ $twitter ? 'Connected' : 'Pending' }}</a>
                </div>
                <p class="text-gray-500 text-sm">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            </div>
            <div class="px-6 py-3 flex flex-row items-center justify-between bg-gray-100">
                <span class="py-1 text-xs font-regular text-gray-900 mr-1 flex flex-row items-center">
                    <span class="ml-1">6 mins ago</span>
                </span>
                <span class="py-1 text-xs font-regular text-gray-900 mr-1 flex flex-row items-center">
                    <span class="ml-1">39 Comments</span>
                </span>
            </div>
        </div>

@if($twitter)
         <!-- CARD 2 -->
        <div class="rounded overflow-hidden shadow-lg flex flex-col">
            <div class="relative">
            <form method="Post" action="{{route('media.twitter.post')}}" enctype="multipart/form-data">
                @csrf
                <div class="border-b border-gray-900/10 pb-12">
                    <div class="col-span-full">
                        <label for="message" class="block text-sm font-medium leading-6 text-gray-900">Post a message</label>
                        <div class="mt-2">
                            <textarea id="message" rows="3"
                             name="message" class="block w-full rounded-md border-0
                              py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 
                              placeholder:text-gray-400 focus:ring-2 focus:ring-inset 
                              focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                        </div>
                    </div>

                    <div class="flex items-center border-b border-b-2 border-teal-500 py-2 mb-4">
                                                <input name="attachment" type="file" accept="image/*" />


                    </div>

                    <div class="mt-6 flex items-center justify-end gap-x-6">
                        <button type="button" class="text-sm mt-4 font-semibold leading-6 text-gray-900">Cancel</button>
                        <button type="submit" class="mt-2 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit</button>
                    </div>
                </div>
                </div>
</div>
            </form>
      @endif


      @if($twitter)
         <!-- CARD 3 -->
        <div class="rounded overflow-hidden shadow-lg flex flex-col">
            <div class="relative">
            <form method="get" action="{{route('media.twitter.gettweet')}}" enctype="multipart/form-data">
                @csrf
                <div class="border-b border-gray-900/10 pb-12">
                    <div class="col-span-full">
                        <label for="query" class="block text-sm font-medium leading-6 text-gray-900">Get Tweet From</label>
                        <div class="mt-2">
                            <textarea id="query" rows="3"
                             name="query" class="block w-full rounded-md border-0
                              py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 
                              placeholder:text-gray-400 focus:ring-2 focus:ring-inset 
                              focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                        </div>
                    </div>

                     <!-- <div class="flex items-center border-b border-b-2 border-teal-500 py-2 mb-4">
                                                <input name="attachment" type="file" accept="image/*" />


                    </div>  -->

                    <div class="mt-6 flex items-center justify-end gap-x-6">
                        <button type="button" class="text-sm mt-4 font-semibold leading-6 text-gray-900">Cancel</button>
                        <button type="submit" class="mt-2 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit</button>
                    </div>
                </div>
                </div>
</div>
            </form>
      @endif
           
</div>
</body>
</html>
