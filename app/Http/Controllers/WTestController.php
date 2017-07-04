<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WTest;
use App\Test;
class WTestController extends Controller
{
    public function store(Request $req)
    {
    	$write_test=new WTest;
       $write_test->test_id=$req->test_id;
       if(!$req->hasFile('document_answer'))
        {
          $write_test->explan=$req->answer;
        }
      else
        { 
            $nameDoc=time().".".$req->document_answer->getClientOriginalExtension();

            $req->document_answer->move('document/test/', $nameDoc);

            $write_test->explan=$nameDoc;
            $write_test->is_document_explan=1;
        }

        if(!$req->hasFile('document'))
        {
            $write_test->content=$req->question;
        }
        else
        {
            $nameDoc=time().".".$req->document->getClientOriginalExtension();

            $req->document->move('document/test/', $nameDoc);

            $write_test->content=$nameDoc;
            $write_test->is_document=1;
        }
       
       $write_test->save();

       $test = Test::find($req->test_id);
       $test->state = 1;
       $test->save();
       return redirect('tests');
    }
}
