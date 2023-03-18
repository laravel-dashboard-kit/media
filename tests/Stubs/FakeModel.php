<?php

namespace LDK\Media\Tests\Stubs;

use Illuminate\Database\Eloquent\Model;
use LDK\Media\Models\Behaviors\HasMedia;

class FakeModel extends Model
{
    use HasMedia;

    protected $table = 'fake_model';
}
