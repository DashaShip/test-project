<?php

namespace App\Traits;



use App\Models\File;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

Trait ImageTrait
{

    /**
     * @return HasOne
     */
    public function file(): HasOne
    {
        return $this->hasOne(File::class, 'id', 'image_id');
    }

    /**
     * @return File|null
     */
    public function getFile(): ?File
    {
        return $this->file;
    }

    /**
     * @param UploadedFile $uploadedFile
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function uploadFile(UploadedFile $uploadedFile): void
    {
        /**@var Storage $storage */
        $storage = Storage::disk('public');
        $name = Str::slug($this->getName()) . '-' . $this->getkey() . '.jpg';
        $path = 'images/' . $name;


        $storage->put($path, $uploadedFile->get());
        $file = $this->getFile();
        $path .= '?' . Carbon::now();

        if ($file !== null) {
            $file->update([
                'uses_id' => auth()->id(),
                'name' => $name,
                'path' => $path,
            ]);
        } else {
            $file = $this->file()->create([
                'user_id' => auth()->id(),
                'name' => $name,
                'path' => $path,
            ]);
        }
        $this->update(['image_id' => $file->getKey()]);
    }

    /**
     * @return string|null
     */
    public function getImagePath(): ?string
    {
        $result = null;
        if ($this->getFile() !== null) {
            $result = '/storage/' . $this->getFile()->getPath();
        }
        return $result;
    }
}
