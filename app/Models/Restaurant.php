<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Restaurant
 * 
 * @property int $Restaurant_ID
 * @property string $Restaurant_Name
 * @property string $Restaurant_Location
 * 
 * @property Collection|Menu[] $menus
 * @property Collection|MenuManager[] $menu_managers
 *
 * @package App\Models
 */
class Restaurant extends Model
{
	protected $table = 'restaurant';
	protected $primaryKey = 'Restaurant_ID';
	public $timestamps = false;

	protected $fillable = [
		'Restaurant_Name',
		'Restaurant_Location'
	];

	public function menus()
	{
		return $this->hasMany(Menu::class, 'Restaurant_ID');
	}

	public function menu_managers()
	{
		return $this->hasMany(MenuManager::class, 'Restaurant_ID');
	}
}
