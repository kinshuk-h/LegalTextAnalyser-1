<?php

namespace Database\Seeders;

use App\Models\Labels;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // for($i=1;$i<=10;$i++){
        //     Labels::updateOrCreate(
        //         ['label_num' => $i],
        //         [
        //             'label_num' => $i,
        //             'label_name' => 'Label '.$i,
        //             'details' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Incidunt corporis, vel quod magni, odit, rem a quo minima quae numquam necessitatibus fuga soluta! Iure modi vitae facilis natus voluptates neque.'
        //         ]
        //     );
        // }
        $labels = json_decode('[
            {
              "Label": "Facts ",
              "Short Description": "Facts includes the events that leads to a lawsuit by a party."
            },
            {
              "Label": "Time Line ",
              "Short Description": "It is the logical sequence and outline of the overview of the events."
            },
            {
              "Label": "Issue ",
              "Short Description": "Issue is the dispute of a case. It may be of fact or law or both. It is why parties come to litigation. "
            },
            {
              "Label": "Statutes ",
              "Short Description": "A formally written down rule or set of rules which has been made by a legislative body is called a statute"
            },
            {
              "Label": "Plaintiff\'s Contention ",
              "Short Description": "It is a set of statements made by the Plaintiff in order to prove their stance."
            },
            {
              "Label": "Defendant\'s Contention ",
              "Short Description": "It is a set of statements made by the Defendant in order to prove their stance."
            },
            {
              "Label": "Prayer ",
              "Short Description": "That part of a bill which asks for relief."
            },
            {
              "Label": "Ratio Decidendi ",
              "Short Description": "it is not the actual decision, but the necessary measures need to reach the judgment. in simple words the principle on which the judgement is based. "
            },
            {
              "Label": "Definitions ",
              "Short Description": "conforming to or permitted by law or established rules"
            },
            {
              "Label": "List of Authorities ",
              "Short Description": "It is the legal books/journals/articles that has been referred by the judges."
            },
            {
              "Label": "Precedents ",
              "Short Description": "The law based on decisions that have been made by judges in the past."
            },
            {
              "Label": "Judgement ",
              "Short Description": "The conclusive adjudicaton of a right that has been claimed."
            },
            {
              "Label": "Order ",
              "Short Description": "The formal expression of any decision of a civil court which is not a decree. Judicial order must contain a discussion of the question at issue and the reasons which prevailed with the court which led to the passing of the order."
            },
            {
              "Label": "Decree ",
              "Short Description": "The formal expression of an adjudication which, so far as regards the court expressing it, conclusively determines the rights of the parties with regard to all or any of the matters in controversy in the suit. "
            },
            {
              "Label": "Sentence ",
              "Short Description": "The punishment imposed on a criminal wrong-doer.\nThe judgement that a court formally pronounces after finding a criminal defendant guilty."
            },
            {
              "Label": "Relief ",
              "Short Description": "The redress or benefit, esp. equitable in nature, that a party asks of a court."
            },
            {
              "Label": "Impugned order",
              "Short Description": "An impugned order is an order which has been challanged."
            },
            {
              "Label": "Background",
              "Short Description": ""
            },
            {
              "Label": "Operative",
              "Short Description": ""
            }
        ]',true);

        foreach($labels as $key=>$label){
            Labels::create([
                'label_num' => $key+1,
                'label_name' => $label["Label"],
                'details' => $label["Short Description"]
            ]);
        }

    }
}
