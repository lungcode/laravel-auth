# laravel-auth
Đây là project demo về phân quyền route action trong laravel
![Lủng code](https://scontent.xx.fbcdn.net/v/t1.0-9/104874349_170937931087375_5407629992833896567_o.png?_nc_cat=101&_nc_sid=dd9801&_nc_ohc=ROZI8EvbLscAX8-lUOn&_nc_ht=scontent.fhan3-3.fna&oh=57228a39b98320cfafcd32c8c39e7edb&oe=5F300E56&_nc_fr=fhan3c03)
## Nội dung các video trên youtube 
#### Phần 1 - Phân tích cơ sở dữ liệu [Link youtube](https://www.youtube.com/watch?v=peTp9JmDx9k&list=PLFWDoeAHRLTaotGFjm6JZMZfhxCanFCGs&index=1)
#### Phần 2 - Đăng ký phương thức kiểm tra quyền cho model User [Link youtube](https://www.youtube.com/watch?v=kJeLIMi8xuc&list=PLFWDoeAHRLTaotGFjm6JZMZfhxCanFCGs&index=2)
#### Phần 3 - Gán roue action cho role và gán role cho user [Link youtube](https://www.youtube.com/watch?v=azpQeaOYt7U&list=PLFWDoeAHRLTaotGFjm6JZMZfhxCanFCGs&index=3)
#### Phần 4 - Lấy dữ liệu route acion đã gán cho user thông qua role [Link youtube](https://www.youtube.com/watch?v=RhFgMnORuj0&list=PLFWDoeAHRLTaotGFjm6JZMZfhxCanFCGs&index=4)
#### Phần 5 - Danh sách tất cả route action của admin khi thêm mới role [Link youtube](https://www.youtube.com/watch?v=Aq_ZvY0r_0M&list=PLFWDoeAHRLTaotGFjm6JZMZfhxCanFCGs&index=5)
#### Phần 6 - Chỉnh sửa role, Checked các route action khi chỉnh sửa [Link youtube](https://www.youtube.com/watch?v=8oPaBmVnGDs&list=PLFWDoeAHRLTaotGFjm6JZMZfhxCanFCGs&index=6)
#### Phần 7 - Chỉnh sửa user, Checked các group đã gán cho user [https://www.youtube.com/watch?v=WUS4E4A_jXU&list=PLFWDoeAHRLTaotGFjm6JZMZfhxCanFCGs&index=7)
#### Phần 8 - ÁP dụng phần quyền - thông báo lỗi khi không có quyền [Link youtube](https://www.youtube.com/watch?v=rOvVf6NNV1M&list=PLFWDoeAHRLTaotGFjm6JZMZfhxCanFCGs&index=8)
#### Phần 9 - Quản lý menu - Ẩn các menu khi user không có quyền [Link youtube](https://www.youtube.com/watch?v=rLUvmrzc0EA&list=PLFWDoeAHRLTaotGFjm6JZMZfhxCanFCGs&index=9)

## Các bước cơ bản để thực hiện phân quyền trong laravel 7

## Check quyền với phương thúc can('tham-số')
> Trong đó 'tham-số'' là bất kỳ cái gì mà bạn muốn truyền vào để xử lý, ở trong phần này tôi sử dụng tham số là các route name
Cú pháp có dạng

```php 
	$user = Auth::user();
	if($user->can('category.index')){

	}
```
Và thường được sử dụng tại Authenticate Middleware với route là cái hiện tại người dùng đăng truy cập trên url 
Tham khả code sau tại hàm handle	
```php 
<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */

    public function handle($request, Closure $next)
    {
        if (!Auth::check()) { // chưa đăng nhập
            return redirect()->route('admin.login');
        }
        
        $user = Auth::user(); // lấy thông tin user khi đã đăng nhâp
        // kiemr tra quyền của người dùng
        $route = $request->route()->getName();

        if($user->cant($route)){
             return redirect()->route('admin.error',['code' => 403]);
        }
        
        return $next($request);
    }
}
```

#### Đăng ký thêm phương thức cho đối tượng Auth()->user()
> Bước này nhằm thực hiện xử lý phần so sánh các roure name đã truyền vào khi sử dụng hàm can('category.name') xem có phù hợp với quyền đã gán cho user này chưa
Để đăng ký ta mở file **AuthServiceProvider** trong thư mục **App\Providers**
Khai báo trong hàm boot như code dưới đây
```php 
<?php
namespace App\Providers;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Contracts\Auth\Access\Authorizable;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     * Đăng ký phương thức hasPermission cho đối tượng user
     */
    public function boot()
    {
        $this->registerPolicies();
        app(Gate::class)->before(function(Authorizable $auth, $route){
        	// Đăng ký phương thức hasPermission
            if(method_exists($auth,'hasPermission')){
                return $auth->hasPermission($route) ? $auth->hasPermission($route): false;
            }
            
            return false;
        });
        //
    }
}
``` 
Sau khi đăng ký xong trong model App\User cần khai báo thêm phương thức đã đăng ký ở trên để xử lý logic
```php 
<?php

namespace App;

use App\Models\Role;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    public function hasPermission($route){
        $routes = $this->routes();
        return in_array($route,$routes) ? true : false;
    }

    // cacs route ddax dduowcj gans cho nguowif dungf nayf
    public function routes(){
        $data = [];
        foreach($this->getRoles as $role){
            $permission = json_decode($role->permissions);
            foreach($permission as $per){
                if(!in_array($per,$data)){
                    array_push($data,$per);
                }
            }
        }

        return $data;
    }

    public function getRoles(){
        return $this->belongsToMany('App\Models\Role','user_roles','user_id','role_id');
    }

}
```
#### Các bước còn lại là phần thêm sửa xóa gán quyền cho người dùng
> Ở các bước này thì cần chú ý về CSDL cho hợp lý để 
Một user có thể tham gia nhiều nhóm quyền
Một nhóm quyền có nhiều route action name
Một route action name có trong hiều nhóm quyền khác nhau
VD
Người dùng Hoàng Văn Bảo có id là 1, thuộc nhóm quyền Product Manager và nhóm Sale Manager ...
Người dùng **Trần Kim Anh thuộc** nhóm quyền Sale Manager...
Trong nhóm quyền Product Manager có các route action name như: product.idnex, product.show, product.create, product.edit, product.destroy...