<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Learn German Online - Form</title>
    <link rel="stylesheet" href="{{ url('assets/vendors/core/core.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/demo_1/style.css') }}">

<body>
    <div class="container mt-4">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <img src="https://iaos.de/wp-content/uploads/2019/03/logo.png" alt="" srcset="">
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12 text-right bg-secondary">
                        {{date('d F Y')}}
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        <p>
                            {{$candidateInfo->first_name}} {{$candidateInfo->sur_name}}<br>
                            {{$candidateInfo->address}} <br>
                            Email:  {{$candidateInfo->email}}<br>
                            Passport No.: {{$candidateInfo->passport_no ?? ''}}<br>
                        </p>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        <p><u>Reference Number: {{$aafInfo->reference_no}}</u></p>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        <p>
                            Dear {{$candidateInfo->first_name}} {{$candidateInfo->sur_name}}, <br>
                            Thank you very much for your recent application to study {{$courseInfo->course_name}} Program ({{$courseInfo->course_code}}) offered by IAS College in cooperation with partners. We are pleased to inform you that your application & admission to the contact study program has been successful and that you have received the following offer:
                        </p>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        <p>
                            Offer Status: Valid for WS2022 <br>
                            Course: E-STEP (International Advanced level School Program)<br>
                            Course Field: T or M or W<br>
                            Course Fee: 12500€<br>
                            Scholarship: (If applicable)<br>
                            Final Fees:
                        </p>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        <p>
                            Duration: One year E-STEP at IAS College Campus in Germany and after successful completion then 3 years of bachelor studies at a German University. This Admission Acceptance Form (AAF) is for the E-STEP program, done in prior to start of your bachelor studies. Please do sign and return the acceptance form within 7 days. If you have any queries regarding this offer please feel free to contact us by Email admissions@iaos.de.
                        </p>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        <p>
                            Once you have accepted your admission offer, we require you to pay the non-refundable administration fee of 1.000€ at the latest on or before «Zahlungsfrist_für_AAF». The remaining fee (xxxx€) will be due within 7 days of a successful visa stamping & prior to landing in Germany. We are unable to issue your Original Admission letter for the E-STEP until the administration fees has been paid & other rules and regulations applicable for a successful admission and visa are followed. It is important that to start your Bachelor studies a Studienkolleg or an Equivalent program is in need. This could be obtained by successfully completing the International Advanced Level (E-STEP). German Language classes are also taught in parallel to subjects. It is important to make sure your payment, your certificates and other necessary documents reaches us on time for a smooth admission & visa process and for you to join your course on time. </p>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        <p>
                            <b>Bank Details:</b><br>
                            Account Holder: IAS College GmbH<br>
                            Bank: Deutsche Bank, Luebeck (address: Kohlmarkt 7-15, D-23552 Lübeck)<br>
                            IBAN: DE80 2307 0700 0036 5551 00<br>
                            BIC: DEUTDEDB237
                        </p>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        <p>
                            Details regarding your course start date, travel, Insurance and accommodation will be sent to you once your visa for Germany has been approved. <br>

                            Please return the acceptance form within 7 days once you have made a decision to accept this admission offer. If you have any queries regarding this offer please feel free to contact us by Email admissions@iaos.de.

                        </p>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        <h5 class="text-center">
                            <u>Admission Acceptance Form</u>
                        </h5>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        <p>
                            Name: «Vorname» «Nachname»<br>
                            Date of Birth: «Geburtsdatum»<br>
                            Passport No.: «Passnummer»<br>
                            Course of Study: GVET Azubi 3.5<br>
                            Year and Semester of Entry: AB 2022 SO

                        </p>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        I would like to accept the offer <input type="checkbox" name="" id="">
                    </div>
                    <div class="col-md-12">
                        I would like to decline the offer <input type="checkbox" name="" id="">
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        <p>
                            Declaration <br><br>
                            ``I hereby declare that I have read the Terms and Conditions of this Admission and I formally accept this offer´´.
                        </p>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <p>Signature :....................................................................</p>
                    </div>
                    <div class="col-md-6">
                        <p>Date :....................................................................</p>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12 border">
                        <p class="mt-4">
                            To receive your original duly signed Admission letter & If applicable to obtain the Bachelor offer letter with the prerequisite conditions (Vorläufigezulassung/Zulassungsbescheid) you will need to:-
                        </p>
                        <p>
                            A) Complete and return this Admission Acceptance Form (AAF). <br>
                            B) Transfer the non-refundable administration fee of 1.000€ <br>
                            C) A valid school certificate and other relevant documents and rules are followed. <br>
                            <b><u>To start the E-STEP in Germany:</u></b><br>
                            D) Make remaining fees payment of XXX€ towards your course fees within 7 days of successful Visa stamping & before arrival in Germany.<br>
                            <b><u>And to start the Bachelor Studies:</u></b><br>
                            E) Complete ESTEP successfully<br>
                        </p>
                        <p>
                            A scanned copy of this AAF is valid for all purposes. No need for the Original to be sent via post. Please scan your acceptance form and send by email to admissions@iaos.de or upload it via the IAS Student Portal.
                        </p>
                        <br>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        <h5>Terms & Conditions</h5>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        <p>
                            <b>1)</b> Tuition fees & all other payments need to be paid only via bank transfer to the account mentioned in the acceptance form. In case of acceptance of admission, the acceptance form needs to be filled and returned to us within 7 days & all payments must be made within two weeks from the date of acceptance. All payments must be made in Euros (€). Any currency conversion costs or other charges incurred in making the payment or in case of a refund shall be borne by the candidate or the third party making payment and shall not be deductible from the amounts due to the College & its partners. Payment of tuition fees by a person or organization other than the candidate does not constitute a contract for admission to the College, nor for the provision of a program of study between such person or organization and the College & its partners.
                        </p>
                        <p class="mt-4">
                            <b>2)</b> The duly signed admission letter for the English Study Eligibility Program you have been admitted and if applicable the Bachelor offer letter with the prerequisite conditions (Vorläufigezulassung oder Zulassungsbescheid) will be sent as an Email (PDF Copy). If in need of original letters, then for a fee (courier Charges) the letters will be posted to candidate’s address as given in their given in the Candidate Profile Form (CPF). In case of a change in details the candidate must provide prior notification.
                            The Registration (immatriculation) is officially completed with the signing of the Study rules and regulations (Studienordnung) of the college & registration at the relevant Aliens office in Germany upon arrival in Germany. From this point forward, the candidate accepts all the rights and responsibilities of the college and will be an official member of the college. In the interests of all course participants, the college reserves the right to enforce the removal of any candidate from the course whose behavior or demeanor is, in their view, considered unacceptable with or without any prior notice. Also the responsible Aliens office & local authorities will be informed.
                        </p>
                        <p class="mt-4">
                            <b>3)</b> Original Admission letter for the E-STEP cannot be provided until the administration fees has been paid and a valid School Certificate has been submitted & other rules and regulations are followed for a successful Admission and Visa.
                            In case of not able to join the semester or the year for which this AAF has been provided, candidates are eligible for the immediate next intake for an additional administration fee of 150 Euros. Admission to any further intakes the candidate must reapply again. It is important that to start the Bachelor studies a Studienkolleg or an Equivalen like E-STEP program must be successfully completed. Also if German langauge is pre-requisite for the University, then such level of German must also needs to be obtained. German language as a subject as well as Extra classes are a part of E-STEP.
                        </p>
                        <p class="mt-4">
                            <b>4)</b> The candidate hereby guarantees that the documents submitted during application process are not tampered or faked. If found, candidate will be removed from the coursework (if already in Germany) or concerned local authorities & or German Consulate/Embassy will be informed (Country from where the candidate applies for a Visa).
                        </p>
                        <p class="mt-4">
                            <b>5)</b> All candidates applying to any course offered by the College & its partners must apply for a German Visa (if applicable) and attend the Visa interview with all the documents and must fulfill all the required conditions (Eg: financial means, blocked account if applicable, Cover letter etc.) as given in the respective German Embassy/Consulate website. The Candidate is solely responsible for the visa appointments and also makes sure to reach Germany on time for their coursework.
                        </p>
                        <p class="mt-4">
                            <b>6)</b> The tuition/course fee is due 7 days before the student/candidate reaches Germany/Campus for the coursework or within 7 days of getting the visa for the coursework (applicable for those students/candidates where a valid visa is a must to enter Germany). If in case of a visa rejection, the College & its partners holds the right to inform candidate to appeal against the decision (remonstration) or apply again for a Visa with further documentation. If the remonstration or reapplication is not positive, then the candidate may request from the College for a course withdrawal form & withdraw from the coursework.
                        </p>
                        <p class="mt-4">
                            <b>7)</b> Course change & cancellation refund policy: 1.000€ is non-refundable fee. Under no circumstances this fee will be refunded. The rest tuition fees is only due as stated in §6. In case that the student/candidate wants to change the coursework or the intake after landing in Germany it is not possible. In some cases if the concerned authorities, the partners do agree then the College along with its partners will try to find a solution. The College makes the final decision and is made on individual basis. If the student/candidate want to cancel the coursework after obtaining the visa & landed in Germany for the coursework, then no refund is possible. The concerned local and visa authorities will be informed of the decision and the current visa will be cancelled & or will not be extended (in case an extension is in need).
                        </p>
                        <p class="mt-4">
                            <b>8)</b> Partial cancellation refunds are possible in exceptional circumstances (severe illness/medical attention is in need for the student/candidate, which could be proven by proper medical documents & needs medical attention in home country for more than 6 months (Note: Only those illness/medical conditions obtained after applying to IAS Programs), in case of death of the applicant or sudden demise of other family member (parents, children or partner by marriage) once the applicant has signed and sent us the withdrawal form wherever applicable. The College holds the right to decide the refund percentage and is determined individually. Once the decision has been made on the refund amount, it will take 2 to 4 weeks for the refund process.
                            All refunds will be made to the bank and account holder (or other financial institution) that originally paid the fee unless otherwise the candidate gives in writing or by email a different bank account. Refunds are not made in cash.
                        </p>
                        <p class="mt-4">
                            <b>9)</b> The student/candidate needs to inform in writing & get prior permission from the College & its partners before commencing any short break from the program apart from the semester breaks and other holiday aforementioned for the coursework. In case of candidate taking a break from the program (not more than once) for a short period (less than 15 days) the candidate can join the course again otherwise can join the next batch if the program is still in offer & if the candidate pays the administration fee & fees difference (if any).
                        </p>
                        <p class="mt-4">
                            <b>11)</b> We will make all reasonable efforts to deliver the course as outlined on the website and in the brochures. However we reserve the right to:- <br>
                            ● Make reasonable adjustment to the timetable, location or presenters specified for a Course; and <br>
                            ● Make reasonable amendments to the content and syllabus of a Course when necessary. <br>

                            Neither the student/candidate nor the College shall be liable for delay in performing obligations or for failure to perform obligations hereunder if the delay or failure results from: force majeure, an Act of God, or any governmental act, fire, earthquake, explosion, accident, industrial dispute, civil commotion or anything beyond the control of either Party. The student/candidate and the college shall use all reasonable endeavors to minimize any such delay. Upon cessation of the event-giving rise to the delay both the student/candidate and the college shall insofar as may be practicable under the circumstances, complete performance of their respective obligations hereunder.
                        </p>
                        <p class="mt-4">
                            <b>12)</b> Cancellation by us: We reserve the right to cancel any course by giving you a notice in writing at any time before the course is due to start or during the course. College will refund the rest non-used tuition fees (If an ongoing course has to be terminated) and or will endeavor to offer a transfer to another course as an alternative, subject to payment or refund of any difference in the fees as applicable.
                        </p>
                        <p class="mt-4">
                            <b>13)</b> The College & its partners may take visual and/or audio recordings of candidates, emails & contact details or email forwards from students/candidates before, after or during the course and reserve the right to use these for administrative, management, promotional, or educative purposes (in Germany and overseas). It is understood that the Candidate’s individual consent for this purpose is granted unless otherwise indicated by student/candidate in writing or by email prior to the start of the course. Those already in use or used will be unaffected.
                        </p>
                        <p class="mt-4">
                            <b>14) Legal basis: </b><br>
                            The College & its partners will not accept liability for any costs or losses incurred by student/candidate or organizations which are claimed to have arisen through joining the course or by cancellation, other than for those stated here.
                        </p>
                        <p class="mt-4">
                            <b>15) Governing Law </b><br>
                            These Terms and Conditions are governed by and to be construed in accordance with German law. If from the Amendment to this law in force arising from new laws or regulations, the need for any modifications of individual or all programs of the College and its partners are not liable there for. Any disputes shall be subject to the exclusive jurisdiction of the German courts; in this case the court of law is Luebeck, Germany. Any form of Oral contract/agreements are not legally binding.
                        </p>
                        <p class="mt-4">
                            These Terms and Conditions are subject to change without notice, from time to time in our sole discretion. We will notify you to the amendments to these terms and conditions by posting them in our website (Official website – www.iaos.de)
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    window.print();
</script>
</html>
