<div>
    <label for="title">Title</label>
    <input id="title" type="text" name="title" placeholder="Title" value="{{ old('title',  isset($article->title) ? $article->title : null) }}">
    @error('title')
    <div>{{ $message }}</div>
    @enderror
</div>
<div>
    <label for="body">Body</label>
    <textarea id="body" type="text" name="body" cols="30" rows="10">{{ old('body',  isset($article->body) ? $article->body : null) }}</textarea>
    @error('body')
    <div>{{ $message }}</div>
    @enderror
</div>
<div>
    <label for="file">Image</label>
    <input id="file" type="file" name="image" accept="image">
    @error('image')
    <div>{{ $message }}</div>
    @enderror
</div>


<input type="submit" name="submit">