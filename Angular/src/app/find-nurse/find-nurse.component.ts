import { Component, ElementRef, ViewChild, AfterViewInit } from '@angular/core';
import { nurseService } from '../service/antonio.service';

@Component({
  selector: 'app-find-nurse',
  templateUrl: './find-nurse.component.html',
  styleUrl: './find-nurse.component.css',
  providers: [nurseService]
})

export class FindNurseComponent {
  @ViewChild("nameInput", { static: true }) NurseName!: ElementRef;
  @ViewChild("nurseName", { static: false }) showNurseName!: ElementRef;
  @ViewChild("nurseId", { static: false }) showNurseId!: ElementRef;
  @ViewChild("nurseGmail", { static: false }) showNurseGmail!: ElementRef;
  @ViewChild("nurseTable", { static: false }) nurseTable!: ElementRef;
  ngAfterViewInit() {
    this.NurseName.nativeElement.value = '';
  }
  constructor(private nurseService: nurseService) { }

  findNurse() {
    const inputName = this.NurseName.nativeElement.value.toLowerCase();
    const nurses = this.nurseService.findNurse(inputName);

    this.nurseTable.nativeElement.innerHTML = '';

    if (nurses.length > 0) {
      nurses.forEach(nurse => {
        const row = this.nurseTable.nativeElement.insertRow();
        const cellId = row.insertCell(0);
        const cellName = row.insertCell(1);
        const cellGmail = row.insertCell(2);

        cellId.innerHTML = nurse.id.toString();
        cellName.innerHTML = nurse.name;
        cellGmail.innerHTML = nurse.gmail;
      });
    } else {
      const row = this.nurseTable.nativeElement.insertRow();
      const cell = row.insertCell(0);
      cell.colSpan = 3;
      cell.innerText = "Not found!";
    }
  }
}

class Nurse {
  id: string = '';
  name: string = '';
  pwd: string = '';
  gmail: string = '';
}