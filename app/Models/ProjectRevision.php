<?php

namespace App\Models;

use Spatie\Sitemap\Tags\Url;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sitemap\Contracts\Sitemapable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjectRevision extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'project_revision';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uid',
        'project_id',
        'created_by',
        'freelancer_id',
        'employer_id',
        'amount',
        'days',
        'description',
        'status',
    ];

    /**
     * Get the project associated with this revision.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project_request()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    /**
     * Get the freelancer who created this revision (if applicable).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function freelancer_request()
    {
        return $this->belongsTo(User::class, 'freelancer_id');
    }

    /**
     * Get the employer who created this revision (if applicable).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employer_request()
    {
        return $this->belongsTo(User::class, 'employer_id');
    }
}
