<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class Ilike implements Rule
{
    private $table;
    private $column;
    private $id;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($table, $column, $id = null)
    {
        $this->table = $table;
        $this->column = $column;
        $this->id = $id;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed  $value
     *
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $record = DB::table("{$this->table}")->select('id')
            ->whereRaw("{$this->column} ilike '" . $value . "'");

        if ($this->id != null) {
            $record->whereNotIn('id', [$this->id]);
        }

        $record = $record->first();

        if (isset($record->id)) {
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('validation.unique');
    }
}
