<div class="container">

    <div class="py-12 row">
        <div class="col-md-12">

            <div class="p-6 bg-white">
                {{-- {{$getHello}} --}}

                <form enctype="multipart/form-data" action="{{route('updateBlog')}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <input type="hidden" value="{{$getPostCotent['0']['id']}}" name="post_id">
                            <label for="postImage">Post Image</label>
                            <br>
                            <img src="/uploads/{{$getPostCotent['0']['blog_img']}}" 
                                height="auto" class="rounded w-25 mb-2" alt="No image to display">
                            <input type="file" name="post_image" class="form-control-file" id="postImage" >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="blogTitle">Blog title</label>
                            <input type="text" class="form-control" value="{{$getPostCotent['0']['title']}}" name="blog_title" id="blogTitle" autocomplete="off" required>
                          </div>
                        <div class="form-group col-md-12">
                            <label for="blogContent">Blog content</label>
                            <textarea name="blog_content" id="customTextEditor">{{$getPostCotent['0']['blog_content']}}</textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input"  name="immediately_publish" id="immediatelyPublish"
                                {{ intval($getPostCotent['0']['published_status']) === 1 ? "checked" : ""}}>
                                <label class="custom-control-label" for="immediatelyPublish">immediately publish</label>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <button type="submit" name="submit" class="btn btn-primary">Update</button>
                            <a href="{{route('blog')}}" class="btn btn-secondary">Cancel</a> 
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>

</div>