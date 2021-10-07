<?php

namespace App\Services;

use App\Models\Deposits;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Role;

class DepositsService
{
   /**
     * Create a new Service instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Create a new Deposit
     *
     * @param App\Models\Deposit $deposit
     */
    public function makeDeposit($deposit,$request)
    {
        if(auth()->user()->hasRole('client')){

            $result = $request->file('check_image');
            $checkImage = $result->storeAs('checks', uniqid().'.'.$result->getClientOriginalExtension(), 'check');

            $data = $request->all();
            $data['check_image'] = $checkImage;
            $data['user_id'] = auth()->user()->id;
            $deposit->fill($data);
            $deposit->save();

            return $deposit;

        }else{
            throw ValidationException::withMessages(['Access not allowed']);
        }

    }

    /**
     * Returns a list of pending deposits
     *
     * @return App\Models\Deposit $listDeposit
     */
    public function listDepositPending(){

        if(auth()->user()->hasRole('administrator')){

            return Deposits::whereNull('authorized_by')->with('user')->get();

        }else{
            throw ValidationException::withMessages(['Access not allowed']);
        }

    }

    /**
     * Changes the status of the deposit
     *
     * @return App\Models\Deposit $deposit
     */
    public function alterStatus($request){

        if(auth()->user()->hasRole('administrator')){
            $deposit = Deposits::find($request->deposit_id);
            if(!$deposit){

                return response()->json(array(
                    'errors' => array(
                        ["Deposit not found"]
                    ),
                    "errCode" => 404
                ),404);

            }else{

                if($deposit->authorized_by != null){

                    if($deposit->authorized)
                        throw ValidationException::withMessages(['This deposit has already been approved or disapproved.']);
                    else
                        throw ValidationException::withMessages(['This deposit has already been disapproved.']);

                }else{
                    $deposit->fill($request->all());
                    $deposit->authorized_by = auth()->user()->id;
                    $deposit->save();

                    if($request->authorized){

                        $user = User::find($deposit->user_id);
                        $user->updateClientBalance($deposit->amount,"C");
                        $user->insertLogBalance($deposit->amount,"C",$deposit->id);

                        return response()->json(['success' => true],201);
                    }

                    return response()->json(['success' => true],201);
                }

            }

        }else{
            throw ValidationException::withMessages(['Access not allowed']);
        }

    }

    public function getDetails($id){
        if(auth()->user()->hasRole('administrator')){

            return Deposits::where('id',$id)->with('user')->first();

        }else{
            throw ValidationException::withMessages(['Access not allowed']);
        }
    }




}
