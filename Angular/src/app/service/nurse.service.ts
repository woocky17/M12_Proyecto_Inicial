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
    login(nurse: Nurse): Observable<any> {
        let url = "http://127.0.0.1:8000/NurseController/login";
        let formData = new FormData()
        formData.append("gmail",nurse.gmail)
        formData.append("pwd",nurse.pwd)

        return this.conexHttp.post(url,formData);

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
