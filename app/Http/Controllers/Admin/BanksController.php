<?php

namespace CodeFinance\Http\Controllers\Admin;

use CodeFinance\Events\BankCreatedEvent;
use CodeFinance\Http\Controllers\Controller;
use CodeFinance\Http\Controllers\Response;

use CodeFinance\Models\Bank;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use CodeFinance\Http\Requests\BankCreateRequest;
use CodeFinance\Http\Requests\BankUpdateRequest;
use CodeFinance\Repositories\BankRepository;
use CodeFinance\Validators\BankValidator;

/**
 * Class BanksController.
 *
 * @package namespace CodeFinance\Http\Controllers;
 */
class BanksController extends Controller
{
    /**
     * @var BankRepository
     */
    protected $repository;

    /**
     * @var BankValidator
     */
    protected $validator;

    /**
     * BanksController constructor.
     *
     * @param BankRepository $repository
     * @param BankValidator $validator
     */
    public function __construct(BankRepository $repository, BankValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banks = $this->repository->paginate(5);

//        if (request()->wantsJson()) {
//
//            return response()->json([
//                'data' => $banks,
//            ]);
//        }

        $bank = new Bank();
        $bank->name = "Itau";

        //Testando chamanda de um evento
//        event(new BankCreatedEvent(new Bank()));
        event(new BankCreatedEvent($bank));

        return view('admin.banks.index', compact('banks'));
    }


    public function create() {
        return view('admin.banks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BankCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(BankCreateRequest $request)
    {
        $data = $request->all();
        $data['logo'] = md5(time()) . '.jpeg';

        $this->repository->create($data);

//        if ($request->wantsJson()) {
//            $response = [
//                'message' => 'Bank created.',
//                'data'    => $bank->toArray(),
//            ];
//            return response()->json($response);
//        }

        return redirect()->route('admin.banks.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bank = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $bank,
            ]);
        }

        return view('banks.show', compact('bank'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bank = $this->repository->find($id);

        return view('admin.banks.edit', compact('bank'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  BankUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(BankUpdateRequest $request, $id)
    {
        $this->repository->update($request->all(), $id);

//        if ($request->wantsJson()) {
//            $response = [
//                'message' => 'Bank updated.',
//                'data'    => $bank->toArray(),
//            ];
//            return response()->json($response);
//        }

        return redirect()->route('admin.banks.index');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Bank deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Bank deleted.');
    }
}

