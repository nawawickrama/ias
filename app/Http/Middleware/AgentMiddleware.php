<?php

namespace App\Http\Middleware;

use App\Models\Agent;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        
        if(Auth::check()){
            
            /** @var User $user */
            $user = Auth::user();
            $user_agent = $user->hasRole('Agent');
            
            if($user_agent){
                $agent_details = Agent::where('user_id', $user->id)->count();
                
                if($agent_details == 1){
                    return $next($request);
                    
                }else{
                    return redirect(route('agents'));
                }
            }else{
                return $next($request);
            }
        }
    }
}
