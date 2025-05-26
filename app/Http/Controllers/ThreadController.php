<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Http\Requests\ThreadRequest;
use App\Thread;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class ThreadController extends Controller
{
    private $thread;
    
    public function __construct(Thread $thread)
    {
        $this->thread = $thread;    
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Channel $channel)
    {
        // if(!Gate::allows('access-index-thread')) {
        //     return \dd('Nao tenho permissão');
        // }

        $channelParam = $request->channel;
        if(null !== $channelParam) {
            $threads = $channel->whereSlug($channelParam)->first()->threads()->paginate(15);
        } else {
            $threads = $this->thread->orderBy('created_at', 'DESC')->paginate(15);
        }

        return view('threads.index', compact('threads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Channel $channel)
    {
        return view('threads.create', [
            'channels' => $channel->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\ThreadRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ThreadRequest $request)
    {
        try{
            $thread = $request->all();
            $thread['slug'] = Str::slug($thread['title']);
            
            $user = User::find(1);
            $thread = $user->threads()->create($thread);

            flash('Tópico Criado Com Sucesso!')->success();
            return redirect()->route('threads.show', $thread->slug);

        } catch (Exception $e) {

            $message = env('APP_DEBUG') ? $e->getMessage() : 'Erro Ao Processar Sua Requisição!' ;

            flash($message)->warning();
            return redirect()->back();
        
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $thread
     * @return \Illuminate\Http\Response
     */
    public function show($thread)
    {
        $thread = $this->thread->whereSlug($thread)->first();

        if(!$thread) return redirect()->route('threads.index');
        return view('threads.show', compact('thread'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $thread
     * @return \Illuminate\Http\Response
     */
    public function edit($thread)
    {
        $thread = $this->thread->whereSlug($thread)->first();

        $this->authorize('update', $thread);
        return view('threads.edit', \compact('thread'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\ThreadRequest  $request
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function update(ThreadRequest $request, $thread)
    {
        try{
            $thread = $this->thread->whereSlug($thread)->first();
            $thread->update($request->all());

            flash('Tópico Atualizado Com Sucesso!')->success();
            return redirect()->route('threads.show', $thread->slug);

        } catch (Exception $e) {

            $message = env('APP_DEBUG') ? $e->getMessage() : 'Erro Ao Processar Sua Requisição!' ;
            
            flash($message)->warning();
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $thread
     * @return \Illuminate\Http\Response
     */
    public function destroy($thread)
    {
        try{

            $thread = $this->thread->whereSlug($thread)->first();
            $thread->delete();

            flash('Tópico Removido Com Sucesso!')->success();
            return redirect()->route('threads.index');

        } catch (Exception $e) {
            
            $message = env('APP_DEBUG') ? $e->getMessage() : 'Erro Ao Processar Sua Requisição!' ;
            
            flash($message)->warning();
            return redirect()->back();

        }
    }
}
