import { Injectable, ViewChild, ElementRef, Component } from '@angular/core';
import jsonData from '../data/data.json';
import { FormControl, FormGroup } from '@angular/forms';
import { Router, ActivatedRoute } from '@angular/router';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';

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
    login() {
        let value = this.form.value;

        console.log('Form values:', value); // Muestra los valores ingresados
        console.log('Nurses array:', this.nurses); // Muestra los datos cargados

        const nurse = this.nurses.find(
            (n) =>
                n.gmail.toLowerCase() === value.gmail?.trim().toLowerCase() &&
                n.pwd === value.pwd?.trim()
        );

        if (nurse) {
            alert(`Welcome, ${nurse.name}!`);
            this.router.navigate(['/findOne']);
            this.router.navigate(['/getAll']);
        } else {
            alert('Invalid Gmail or Password');
        }
    }
    getAll(): Observable<Nurse[]> {
        let url = "http://127.0.0.1:8000/NurseController/nurse";
        return this.conexHttp.get<Nurse[]>(url,
            { headers: new HttpHeaders({ 'Content-Type': 'application/json' }) }
        );
    }
    findNurse(inputName: string): Nurse[] {
        return this.nurses.filter(n => n.name.toLowerCase() == inputName.toLowerCase());
    }
}
class Nurse {
    id: string = '';
    name: string = '';
    pwd: string = '';
    gmail: string = '';
}