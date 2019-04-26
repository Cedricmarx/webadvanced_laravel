<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Faker\Provider\DateTime;

class Task extends Model
{    
    protected $note = '';
    protected $complete = false;
    protected $category = '';
    protected $date = null;
    protected $dueDate = null;
}
