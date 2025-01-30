import { Injectable, ViewChild, ElementRef, Component } from '@angular/core';
import jsonData from '../data/data.json';
import { FormControl, FormGroup } from '@angular/forms';
import { Router, ActivatedRoute } from '@angular/router';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Nurse } from '../data/nurse';

@Injectable()
export class nurseService {

    nurses: Nurse[] = jsonData;


    constructor(private conexHttp: HttpClient,
        private router: Router,
        private activatedRoute: ActivatedRoute) { };

    form = new FormGroup({
        gmail: new FormControl(''),
        pwd: new FormControl('')
    });
<<<<<<< HEAD

    signIn() {
        let value = this.form.value;
        console.log('Form values:', value);
        console.log('Nurses array:', this.nurses);

        const nurse = this.nurses.find(
            (n) =>
                n.gmail.toLowerCase() === value.gmail?.trim().toLowerCase() &&
                n.pwd === value.pwd?.trim()
        );

        if (nurse) {
            alert(`Welcome, ${nurse.name}!`);
            this._router.navigate(['/findOne']);
            this._router.navigate(['/getAll']);
        } else {
            alert('Invalid Gmail or Password');
        }
    }

    login() {
        let value = this.form.value;
=======
    login(nurse: Nurse): Observable<any> {
        let url = "http://127.0.0.1:8000/NurseController/login";
        let formData = new FormData()
        formData.append("gmail",nurse.gmail)
        formData.append("pwd",nurse.pwd)
>>>>>>> 164e99f11b5a17d79f619318413e8e564e970a72

        return this.conexHttp.post(url,formData);

    }
<<<<<<< HEAD

    getAll(): Nurse[] {
        return this.nurses;
=======
    
    getAll(): Observable<Nurse[]> {
        let url = "http://127.0.0.1:8000/NurseController/nurse";
        return this.conexHttp.get<Nurse[]>(url,
            { headers: new HttpHeaders({ 'Content-Type': 'application/json' }) }
        );
>>>>>>> 164e99f11b5a17d79f619318413e8e564e970a72
    }

    findNurse(inputName: string): Nurse[] {
        return this.nurses.filter(n => n.name.toLowerCase() == inputName.toLowerCase());
    }
}
