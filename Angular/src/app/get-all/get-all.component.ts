import { Component, OnInit } from '@angular/core';
import jsonData from '../data/data.json';
import { nurseService } from '../service/nurse.service';

@Component({
  selector: 'app-get-all',
  templateUrl: './get-all.component.html',
  styleUrl: './get-all.component.css',
  providers: [nurseService]
})
export class GetAllComponent {
  nurses: Nurse[] = [];

  constructor(private nurseService: nurseService) { }

  ngOnInit(){
    this.getAll();
  }

  getAll() {
    this.nurses = this.nurseService.getAll();
  }
}

class Nurse {
  id: string = '';
  name: string = '';
  pwd: string = '';
  gmail: string = '';
  img: string = '';
} 